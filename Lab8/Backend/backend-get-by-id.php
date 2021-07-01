<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require 'db_connection.php';

try{
    $id = $_GET['id'];
    $sql = "SELECT * FROM data WHERE id=" . $id;
    $result = $mysqli->query($sql);
    $result = $result->fetch_object();

    echo $json = json_encode($result);

}

catch (Exception $exception){
    echo $exception->getMessage();
}