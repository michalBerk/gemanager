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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $customer_id = $_POST["customer_id"];
    $full_name = $_POST["full_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $company_name = $_POST["company_name"];
    $country = $_POST["country"];

    // Prepare and execute the SQL insert query
    $insert_query = "INSERT INTO customers (customer_id, full_name, phone_number, email, company_name, country) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $insert_query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $customer_id, $full_name, $phone_number, $email, $company_name, $country);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Customer added successfully!";
        } else {
            echo "Error adding customer: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>