<?php
$host = 'localhost';
$username = 'ismichalbek_user';
$password = 'w06sa!TUt-u';
$database = 'ismichalbek_diamond_inventory';

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$diamondId = $_GET['diamond_id']; // Assuming you pass the diamond ID as a parameter

// Use a prepared statement to prevent SQL injection
$query = "SELECT * FROM diamonds WHERE diamond_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $diamondId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $diamondData = $result->fetch_assoc();
    echo json_encode($diamondData);
} else {
    echo json_encode(array()); // Return an empty array if no data found
}

$stmt->close();
$conn->close();
?>
