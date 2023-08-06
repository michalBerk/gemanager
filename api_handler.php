<?php
// Function to fetch diamond details from the API
function fetch_diamond_details($api_key, $report_number) {
    // Replace this with your actual API endpoint and query
    $url = 'https://api.reportresults.gia.edu/';
    $headers = [
        'Authorization: ' . $api_key,
        'Content-Type: application/json',
    ];
    $query = '
    {
      getReport(report_number: "' . $report_number . '") {
        results {
          ... on DiamondGradingReportResults {
            shape_and_cutting_style
            measurements
            carat_weight
            color_grade
            clarity_grade
            cut_grade
            polish
            symmetry
          }
        }
        links {
          image
        }
      }
    }';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(['query' => $query]),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $diamond_data = json_decode($response, true);
    return $diamond_data;
}

// Function to insert diamond details into the database
function insert_diamond_details($report_data, $report_number) {
    // Your database connection parameters (adjust them according to your setup)
    $db_host = 'localhost';
    $db_user = 'ismichalbek_user';
    $db_pass = 'w06sa!TUt-u';
    $db_name = 'ismichalbek_diamond_inventory';

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO diamonds (
            diamond_id, measurements, carat, color, clarity, cut,
            polish, symmetry, image, status, cos_cust,
            sold_cust, inserted_date, price_per_carat, total_price
        ) VALUES ('
            . $report_number . ', :measurements, :carat, :color, :clarity,
            :cut, :polish, :symmetry, :image, :status, :cos_cust,
            :sold_cust, :inserted_date, :price_per_carat, :total_price
        )';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':measurements', $report_data['measurements']);
        $stmt->bindParam(':carat', $report_data['carat_weight']);
        $stmt->bindParam(':color', $report_data['color_grade']);
        $stmt->bindParam(':clarity', $report_data['clarity_grade']);
        $stmt->bindParam(':cut', $report_data['cut_grade']);
        $stmt->bindParam(':polish', $report_data['polish']);
        $stmt->bindParam(':symmetry', $report_data['symmetry']);
        $stmt->bindParam(':image', $report_data['links']['image']);
        // Set the remaining columns to empty values for now
        $status = 'Available';
        $cos_cust = '';
        $sold_cust = '';
        $inserted_date = date('Y-m-d');
        $price_per_carat = 0.0;
        $total_price = 0.0;
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':cos_cust', $cos_cust);
        $stmt->bindParam(':sold_cust', $sold_cust);
        $stmt->bindParam(':inserted_date', $inserted_date);
        $stmt->bindParam(':price_per_carat', $price_per_carat);
        $stmt->bindParam(':total_price', $total_price);

        $stmt->execute();
    } catch (PDOException $e) {
        // Handle the database insertion error here
        echo '<p>Error: ' . $e->getMessage() . '</p>';
    }
}


// Main API request handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api_key = 'd14d5d91-f293-470e-991a-cf08c76df37f';
    $report_number = $_POST['report_number'];

    $diamond_data = fetch_diamond_details($api_key, $report_number);
    if ($diamond_data && isset($diamond_data['data']['getReport']['results'])) {
        $report_data = $diamond_data['data']['getReport']['results'];
        echo '<h2>API Data:</h2>';
        echo '<pre>';
        print_r($report_data);
        echo '</pre>';
        // Insert the diamond details into the database
        insert_diamond_details($report_data, $report_number);

        echo '<p>Data fetched and inserted successfully!</p>';
    } else {
        echo '<p>Error: Failed to fetch data from the API</p>';
    }
}
