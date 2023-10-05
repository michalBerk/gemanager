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
$query = "SELECT * FROM diamonds";
$result = mysqli_query($connection, $query);

// Loop through the results and populate the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['diamond_id']}</td>";
    echo "<td>{$row['shape_cutting_style']}</td>";
    echo "<td>{$row['measurements']}</td>";
    echo "<td>{$row['weight']}</td>";
    echo "<td>{$row['color']}</td>";
    echo "<td>{$row['clarity']}</td>";
    echo "<td>{$row['cut']}</td>";
    echo "<td>{$row['polish']}</td>";
    echo "<td>{$row['symmetry']}</td>";
    echo "<td>{$row['inserted_date']}</td>";
    echo "<td>{$row['price_per_carat']}</td>";
    echo "<td>{$row['total_price']}</td>";
    echo "<td>{$row['status']}</td>";
    echo "</tr>";
}

// Close the database connection
mysqli_close($connection);
?>