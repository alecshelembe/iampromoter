<?php

// metrofibre callback function endpoint is recieved here(below)
function sanitizeLatLong($input) {
    // Remove any leading or trailing whitespace
    $input = trim($input);
    
    // Remove any non-numeric characters and dots
    $input = preg_replace("/[^0-9.-]/", "", $input);
    
    // Convert to a floating-point number
    $coordinate = (float) $input;
    
    // Check if the coordinate is within valid range for latitude (-90 to 90) or longitude (-180 to 180)
    if (($coordinate >= -90 && $coordinate <= 90) || ($coordinate >= -180 && $coordinate <= 180)) {
        return $coordinate;
    } else {
        return false; // Invalid coordinate
    }
}

if(isset($_GET['latitude'])){
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $latitude = sanitizeLatLong($latitude);
    $longitude = sanitizeLatLong($longitude);
} else {
    // Test the function
    $latitude = "-33.9629939";  
    $longitude = "18.4725439";  
}
$point = [$longitude,$latitude];

function findPolygons($kmlFile) {
    $dom = new DOMDocument();
    $dom->load($kmlFile);
    
    $polygons = [];
    
    $placemarks = $dom->getElementsByTagName('Placemark');
    $polygons = array(); // Initialize an array to store polygon data
    
    foreach ($placemarks as $placemark) {
        $polygonNodes = $placemark->getElementsByTagName('Polygon');
        if ($polygonNodes->length > 0) {
            // Extract polygon data
            $polygonNode = $polygonNodes->item(0); // Get the first <Polygon> element
            $outerBoundaryNode = $polygonNode->getElementsByTagName('outerBoundaryIs')->item(0);
            $linearRingNode = $outerBoundaryNode->getElementsByTagName('LinearRing')->item(0);
            $coordinates = $linearRingNode->getElementsByTagName('coordinates')->item(0)->textContent;
            
            // Add the extracted coordinates to the polygons array
            $polygons[] = $coordinates;
        }
    }
    
    // Now the $polygons array should contain the coordinates for each <Polygon> element
    // print_r($polygons);
    
    
    return $polygons;
}


function pointInPolygon($point, $polygon) {
    $coordinates = explode(' ', trim($polygon));
    // $point = substr($point, 0, -2);
    $numPoints = count($coordinates);
    $intersectCount = 0;
    $next = 0;
    for ($current = 0; $current < $numPoints; $current++) {
        $next = ($current + 1) % $numPoints;
        
        $coordCurrent = explode(',', trim($coordinates[$current]));
        $coordNext = explode(',', trim($coordinates[$next]));
        
        if (
            ($coordCurrent[1] > $point[1]) != ($coordNext[1] > $point[1]) &&
            ($point[0] < ($coordNext[0] - $coordCurrent[0]) * ($point[1] - $coordCurrent[1]) / ($coordNext[1] - $coordCurrent[1]) + $coordCurrent[0])
            ) {
                $intersectCount++;
            }
        }
        
        return ($intersectCount % 2) == 1;
    }
    
    
    function searchKMLfileforgivenpoint( $point ) {
        // Packages
        
        $kmlFilePath  = "kml_files/MTB's-FTTH-Polygon.kml";  // Replace with the path to your KML file        
        $polygons = findPolygons($kmlFilePath);
        $polygons = str_replace(array("\n", "\t"), '', $polygons);
        // $result_packages = array_merge($result_packages, $MetroFibrePackages);
        foreach ($polygons as $polygon) {
            if ($answer = pointInPolygon($point, $polygon)) {
                $response_data = array(
                    'long' => $point[0],
                    'lat' =>  $point[1],
                    'source' => 'kml',
                    'coverage' => 'Available',
                    'provider' => 'Seacom',
                );
                return ( $response_data );
            } else{
                $response_data = array(
                    'long' => $point[0],
                    'lat' => $point[1],
                    'source' => 'kml',
                    'coverage' => 'Unavailable',
                    'provider' => 'Seacom',
                );
            }
        }
        return ( $response_data );
    }
    // Send the response as JSON
    $response_data = searchKMLfileforgivenpoint( $point );
    // $response_data = findPolygons( "kml_files/MTB's-FTTH-Polygon.kml";
    header('Content-Type: application/json');
    echo json_encode($response_data);