<?php

require 'Backend/db_connection.php';

?>
<!doctype html>
<html lang="en">
<head>
    <title>Lab7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <form method="POST" action="Backend/backend-add-destinations.php">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
                </div>
                <div class="form-group">
                    <label for="targets">Tourist Targets</label>
                    <input type="text" class="form-control" id="targets" name="targets" placeholder="Enter tourist targets">
                </div>
                <div class="form-group">
                    <label for="cost">Costs</label>
                    <input type="text" class="form-control" id="cost" name="cost" placeholder="Enter estimated daily cost">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="javascript:history.back()" type="button" class="btn btn-danger">Back</a>

            </form>
        </div>
    </div>

</body>
</html>
