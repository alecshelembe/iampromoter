<?php


if(isset( $_GET['longitude'])){

    $longitude = $_GET['longitude'];

    $latitude = $_GET['latitude'];

} else {

    $latitude = -26.2041;

    $longitude = 28.0473;

}


// Build the URL with the latitude and longitude values

$url = "https://apps.openserve.co.za/gis/apps/api/ucmTechOSFibre?LAT=$latitude&LON=$longitude";



// Initialize a cURL session

$ch = curl_init();



// Set cURL options

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



// Perform the cURL request

$response = curl_exec($ch);



// Check for cURL errors

if (curl_errno($ch)) {

    echo "cURL Error: " . curl_error($ch);

} else {

    // Decode the JSON response

    $data = json_decode($response, true);



    // Check the FTTH_Status and handle accordingly

    if (isset($data['FTTH_Status']) && $data['FTTH_Status'] == 'Unavailable') {

        // Handle the case when FTTH is unavailable

        $response_data = array(

            'long' =>$longitude,

            'lat' => $latitude,

            'source' => 'Api',

            'coverage' => 'Unavailable',

            'provider' => 'Openserve',

        );

    } else {

        $response_data = array(

            'long' =>$longitude,

            'lat' => $latitude,

            'source' => 'Api',

            'coverage' => 'Available',

            'provider' => 'Openserve',

        );

    }

}

// echo("<script>alert('hello')</script>");



// Close the cURL session

curl_close($ch);

header('Content-Type: application/json');

echo json_encode($response_data);

?>

