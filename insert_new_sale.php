<?php
$host = 'localhost';
$username = 'ismichalbek_user';
$password = 'w06sa!TUt-u';
$database = 'ismichalbek_diamond_inventory';

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the JavaScript code
$data = json_decode(file_get_contents("php://input"));

$diamond_id = $data->certificateNumber;
$customer_id = $data->customerId;
$date = date("Y-m-d");
$unique_sale_id = uniqid(); // Generate a unique sale ID
$total_price_after_tax = $data->finalPrice;

// Update the status of the diamond to "Sold"
$update_status_query = "UPDATE diamonds SET status = 'Sold', sold_cust = ? WHERE diamond_id = ?";
$stmt_update = $conn->prepare($update_status_query);
$stmt_update->bind_param("ss", $customer_id, $diamond_id);

$response = array();

if ($stmt_update->execute()) {
    $response['success'] = true;
    $response['message'] = "Diamond updated successfully!";
} else {
    $response['success'] = false;
    $response['message'] = "Error updating diamond: " . $stmt_update->error;
}

$stmt_update->close();

// Insert sale details into the sales table
$insert_query = "INSERT INTO sales (sale_id, customer_id, diamond_id, total_price, date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("sssss", $unique_sale_id, $customer_id, $diamond_id, $total_price_after_tax, $date);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Sale recorded successfully!";
} else {
    $response['success'] = false;
    $response['message'] = "Error recording sale: " . $stmt->error;
}

$stmt->close();

// Close the database connection
$conn->close();

// Send the response back to the JavaScript code
header('Content-Type: application/json');
echo json_encode($response);
?>
