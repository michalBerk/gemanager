<?php
function fetch_diamond_details($api_key, $report_number) {
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
        links {
          image
          polished_image
          polished_video
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api_key = 'd14d5d91-f293-470e-991a-cf08c76df37f'; // Your API key
    $report_number = $_POST['report_number'];

    // Fetch diamond details using the API function
    $diamond_data = fetch_diamond_details($api_key, $report_number);

    if ($diamond_data && isset($diamond_data['data']['getReport']['results'])) {
        $report_data = $diamond_data['data']['getReport']['results'];

        // Echo the diamond data as JSON response
        echo json_encode($report_data);
    } else {
        echo json_encode(['error' => 'Failed to fetch data from the API']);
    }
}
?>
