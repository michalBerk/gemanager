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
          ... on IdentificationReportResults {
            weight
            measurements
            shape
            cutting_style
            color
          }
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
        
        if (isset($report_data['results']['shape_and_cutting_style'])) {

            $sql = 'INSERT INTO diamonds (
                diamond_id, shape_cutting_style, measurements, weight, color, clarity, cut,
                polish, symmetry, status, cos_cust,
                sold_cust, inserted_date, price_per_carat, total_price
            ) VALUES ('
                . $report_number . ', :shape_cutting_style, :measurements, :weight, :color, :clarity,
                :cut, :polish, :symmetry, :status, :cos_cust,
                :sold_cust, :inserted_date, :price_per_carat, :total_price
            )';
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shape_cutting_style', $report_data['results']['shape_and_cutting_style']);
            $stmt->bindParam(':measurements', $report_data['results']['measurements']);
            $stmt->bindParam(':weight', $report_data['results']['carat_weight']);
            $stmt->bindParam(':color', $report_data['results']['color_grade']);
            $stmt->bindParam(':clarity', $report_data['results']['clarity_grade']);
            $stmt->bindParam(':cut', $report_data['results']['cut_grade']);
            $stmt->bindParam(':polish', $report_data['results']['polish']);
            $stmt->bindParam(':symmetry', $report_data['results']['symmetry']);
            
        } elseif (isset($report_data['results']['shape'])) {
            $sql = 'INSERT INTO diamonds (
                diamond_id, shape_cutting_style, measurements, weight, color, clarity, cut,
                polish, symmetry, status, cos_cust,
                sold_cust, inserted_date, price_per_carat, total_price
            ) VALUES ('
                . $report_number . ', :shape, :measurements, :weight, :color, :clarity,
                :cut, :polish, :symmetry, :status, :cos_cust,
                :sold_cust, :inserted_date, :price_per_carat, :total_price
            )';
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shape', $report_data['results']['shape']);
            $stmt->bindParam(':weight', $report_data['results']['weight']);
            $stmt->bindParam(':measurements', $report_data['results']['measurements']);
            $stmt->bindParam(':cut', $report_data['results']['cutting_style']);
            $stmt->bindParam(':color', $report_data['results']['color']);
            $clarity = '';
            $polish = '';
            $symmetry = '';
            $stmt->bindParam(':clarity', $clarity);
            $stmt->bindParam(':polish', $polish);
            $stmt->bindParam(':symmetry', $symmetry);
        }
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
        $report_data = $diamond_data['data']['getReport'];
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
