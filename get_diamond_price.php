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

// Get the diamond_id from the query parameter
$diamond_id = $_GET["diamond_id"];

// Query to retrieve the total_price based on the provided diamond_id
$sql = "SELECT total_price FROM diamonds WHERE diamond_id = '$diamond_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the total_price
    $row = $result->fetch_assoc();
    $total_price = $row["total_price"];
    
    // Send the total_price as the response
    echo $total_price;
} else {
    // If diamond_id is not found, send an error response
    header("HTTP/1.1 404 Not Found");
    echo "Diamond not found.";
}

// Close the database connection
$conn->close();
?>
