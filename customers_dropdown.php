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

// Query to retrieve customer data
$sql = "SELECT customer_id, full_name FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $selectedCosCust = $_GET['selected_cos_cust']; // Get the selected_cos_cust from the URL parameter
    while ($row = $result->fetch_assoc()) {
        $customer_id = $row["customer_id"];
        $full_name = $row["full_name"];
        $selected = ($customer_id == $selectedCosCust) ? 'selected' : ''; // Check if it matches selected_cos_cust
        echo "<option value='$customer_id' $selected>$full_name</option>";
    }
} else {
    echo "No customers found.";
}

// Close the database connection
$conn->close();
?>
