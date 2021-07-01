<?php
//if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//    echo 'We don\'t have mysqli!!!';
//} else {
//    echo 'Phew we have it!';
//}

session_start();

$mysqli = new mysqli('localhost','matei','mamaligacutocana', 'vacation') or die(mysqli_error($mysqli));

$update = false;
$city = '';
$country= '';
$description= '';
$targets= '';
$cost= '';
$id = 0;
// add
if (isset($_POST['save'])){ //check if the save button has been pressed
    $city = $_POST['city'];
    $country = $_POST['country'];
    $description = $_POST['description'];
    $targets = $_POST['targets'];
    $cost = $_POST['cost'];
    $mysqli->query("INSERT INTO data (city, country, description, targets, cost) VALUES ('$city', '$country', '$description', '$targets', '$cost')") or
            die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");// redirects user back to index.php
}

// delete
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id")
            or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");// redirects user back to index.php
}

// change UI when edit is clicked
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id")
                      or die($mysqli->error);

    if($result == true){ //verify if a row has been found
        $row = $result->fetch_array();
        $city = $row['city'];
        $country = $row['country'];
        $description = $row['description'];
        $targets = $row['targets'];
        $cost = $row['cost'];
    }
}

if (isset($_POST['update'])){
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

    header("location: index.php");// redirects user back to index.php
}


