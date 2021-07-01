<?php

require 'db_connection.php';

session_start();
try {
    $id = $_GET['id'];
    $mysqli->query("DELETE FROM data WHERE id=$id")
    or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
}
catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
}

return header("location:../");

?>
