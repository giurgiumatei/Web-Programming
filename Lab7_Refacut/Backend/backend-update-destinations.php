<?php
require 'db_connection.php';

session_start();
try{
    $id = $_POST['id'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $description = $_POST['description'];
    $targets = $_POST['targets'];
    $cost = $_POST['cost'];

    $mysqli->query("UPDATE data SET city='$city', country='$country', description='$description', targets='$targets', cost='$cost' WHERE id=$id")
    or die($mysqli->error);


    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
}
catch (Exception $exception){
    $_SESSION['message'] = $exception->getMessage();
}

return header("location:../");

?>
