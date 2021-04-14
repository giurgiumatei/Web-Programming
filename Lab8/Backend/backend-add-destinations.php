<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require 'db_connection.php';

$postdata = file_get_contents('php://input');

if(isset($postdata) && !empty(($postdata))) {
    $request = json_decode($postdata);

    $city = $request->city;
    $country = $request->country;
    $description = $request->description;
    $targets = $request->targets;
    $cost = $request->cost;

    $mysqli->query("INSERT INTO data (city, country, description, targets, cost) VALUES ('$city', '$country', '$description', '$targets', '$cost')");
}

?>
