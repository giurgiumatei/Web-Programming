<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require 'db_connection.php';

try {
    $id = $_GET['id'];
    $mysqli->query("DELETE FROM data WHERE id=$id");


}
catch (Exception $e) {
    echo $e->getMessage();
}

?>
