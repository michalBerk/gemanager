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

// Fetch data from the database with a JOIN between sales and customers
$query = "SELECT s.sale_id, c.full_name, s.diamond_id, s.total_price, s.date 
          FROM sales s
          INNER JOIN customers c ON s.customer_id = c.customer_id";

$result = mysqli_query($connection, $query);

// Loop through the results and populate the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['sale_id']}</td>";
    echo "<td>{$row['full_name']}</td>"; // Display the customer's full name
    echo "<td>{$row['diamond_id']}</td>";
    echo "<td>{$row['total_price']}</td>";
    echo "<td>{$row['date']}</td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($connection);
?>
