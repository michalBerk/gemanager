<?php
$db_host = 'localhost';
$db_user = 'ismichalbek_user';
$db_pass = 'w06sa!TUt-u';
$db_name = 'ismichalbek_diamond_inventory';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the JavaScript FormData
$diamondId = $_POST['diamondId'];
$shape = $_POST['shape'];
$measurements = $_POST['measurements'];
$weight = $_POST['weight'];
$color = $_POST['color'];
$clarity = $_POST['clarity'];
$cut = $_POST['cut'];
$polish = $_POST['polish'];
$symmetry = $_POST['symmetry'];
$pricePerCarat = $_POST['pricePerCarat'];
$totalPrice = $_POST['totalPrice'];
$date = $_POST['date'];
$status = $_POST['status'];
$consignmentCustomer = $_POST['consignmentCustomer'];
$buyerCustomer = $_POST['buyerCustomer'];

// Update the database
$sql = "UPDATE diamonds SET
        shape_cutting_style = '$shape',
        measurements = '$measurements',
        weight = '$weight',
        color = '$color',
        clarity = '$clarity',
        cut = '$cut',
        polish = '$polish',
        symmetry = '$symmetry',
        price_per_carat = '$pricePerCarat',
        total_price = '$totalPrice',
        inserted_date = '$date',
        status = '$status',
        cos_cust = '$consignmentCustomer',
        sold_cust = '$buyerCustomer'
        WHERE diamond_id = $diamondId";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true, 'message' => 'Diamond data updated successfully');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Error updating diamond data: ' . $conn->error);
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
