<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require 'db_connection.php';

$vacations = [];
$sql = "SELECT * FROM data";

if($result = $mysqli->query($sql)){
    $cr = 0;
    while($row = $result->fetch_assoc()){
        $vacations[$cr]['id'] = $row['id'];
        $vacations[$cr]['city'] = $row['city'];
        $vacations[$cr]['country'] = $row['country'];
        $vacations[$cr]['targets'] = $row['targets'];
        $vacations[$cr]['cost'] = $row['cost'];
        $cr++;
    }

    echo json_encode($vacations);
}
else {
    http_response_code(404);
}

?>