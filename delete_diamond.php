<?php
// Establish a connection to your MySQL database
$host = 'localhost';
$username = 'ismichalbek_user';
$password = 'w06sa!TUt-u';
$database = 'ismichalbek_diamond_inventory';

$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['diamond_id'])) {
    $diamondId = $_GET['diamond_id'];

    // Prepare and execute a DELETE query to remove the diamond from the database
    $deleteQuery = "DELETE FROM diamonds WHERE diamond_id = ?";
    $stmt = mysqli_prepare($connection, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $diamondId);

    if (mysqli_stmt_execute($stmt)) {
        // Deletion was successful
        $response = ['success' => true];
    } else {
        // Deletion failed
        $response = ['success' => false, 'error' => mysqli_error($connection)];
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // Invalid or missing diamond ID
    $response = ['success' => false, 'error' => 'Invalid or missing diamond ID'];
}

// Convert the response to JSON and send it back
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection (same as your existing code)
mysqli_close($connection);
?>
