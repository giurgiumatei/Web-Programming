<?php
require 'Backend/db_connection.php';

?>


<!DOCTYPE html>
<html>
<head>
    <title>Lab7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="JS Files/script.js"></script>
    <script>


    </script>
</head>
<body>
<div class="container mt-10">
    <div class="row">
        <div class="input-group mt-10 col-12" style='margin-top: 50px;'>
            <div class="form-outline mt-10">
                <input type="search" id="form-type" class="form-control" placeholder="Type country"/>
                <input type="search" id="page-input" style='margin-top: 50px;' class="form-control" placeholder="Type page"/>
            </div>
        </div>
        <div id='result' style="margin-top:100px;">

        </div>

        <a href="javascript:history.back()" type="button" class="btn btn-danger">Back</a>
    </div>
</div>
</body>
</html>