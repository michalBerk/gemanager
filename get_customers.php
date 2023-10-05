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

// Fetch data from the database
$query = "SELECT * FROM customers";
$result = mysqli_query($connection, $query);

// Loop through the results and populate the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['customer_id']}</td>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['company_name']}</td>";
    echo "<td>{$row['country']}</td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($connection);
?>