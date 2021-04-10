<?php
require 'db_connection.php';

session_start();

try{
    $city = $_POST['city'];
    $country = $_POST['country'];
    $description = $_POST['description'];
    $targets = $_POST['targets'];
    $cost = $_POST['cost'];

    $mysqli->query("INSERT INTO data (city, country, description, targets, cost) VALUES ('$city', '$country', '$description', '$targets', '$cost')") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
}
catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
}

return header("location:../");

?>
