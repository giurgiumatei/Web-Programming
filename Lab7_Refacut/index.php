<?php

require 'Backend/db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container text-center">
        <h1>Vacation Destination Manager</h1>
        <?php
        if( isset($_SESSION['message']))
            echo '<div class="alert alert-warning" role="alert">'.$_SESSION['message'].'
        </div>';
        session_destroy();
        ?>
        <div class="row">
            <a href="./add-destinations.php" type="button" class="btn btn-primary mb-2">Add Destination</a>
            <a href="./delete-destinations.php" type="button" class="btn btn-secondary mb-2">Delete Destinations</a>
            <a href="./update-destinations.php" type="button" class="btn btn-success mb-2">Update Destinations</a>
            <a href="./browse-destinations.php" type="button" class="btn btn-danger mb-2">Browse Destinations</a>
        </div>
    </div>
</body>
</html>
