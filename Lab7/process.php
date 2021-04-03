<?php
//if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//    echo 'We don\'t have mysqli!!!';
//} else {
//    echo 'Phew we have it!';
//}

session_start();

$mysqli = new mysqli('localhost','matei','mamaligacutocana', 'vacation') or die(mysqli_error($mysqli));

$update = false;
$name = '';
$location = '';
$id = 0;
// add
if (isset($_POST['save'])){ //check if the save button has been pressed
    $name = $_POST['name'];
    $location = $_POST['location'];
    $mysqli->query("INSERT INTO data (name, location) VALUES ('$name', '$location')") or
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
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id")
            or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");// redirects user back to index.php
}
