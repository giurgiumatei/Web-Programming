<?php
    require 'Backend/db_connection.php';
    $first_sql_statement = "SELECT * FROM data";
    $result = $mysqli->query($first_sql_statement) or die($mysqli->error);
    $page_selected = 1;

    if (isset ($_GET['page'])) {
        $page_selected = $_GET['page'];
    }

    $results_per_page = 4;
    $page_first_result = ($page_selected - 1) * $results_per_page;

    $number_of_results = $result->num_rows;

    $number_of_page = ceil ($number_of_results / $results_per_page);// rounds up

    $query = "SELECT * FROM data LIMIT " . $page_first_result . ',' . $results_per_page;
    $new_result = $mysqli->query($query) or die($mysqli->error);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Lab7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-10">
        <div class="row">
            <ul class="list-group" style="margin-top:100px;">
                <?php
                while ($row = mysqli_fetch_object($new_result)) {
                    echo '<li class="list-group-item">'.$row->city. '<a href="./update-one-destination.php?id='.$row->id.'" class="float-end btn btn-danger">Edit</a> </li>';
                }
                ?>
            </ul>
            <ul class="pagination mt-10">
                <?php
                for($page = 1; $page<= $number_of_page; $page++) {
                    if($page == $page_selected)
                        echo '<li class="page-item active"><a class="page-link" href="update-destinations.php?page='.$page.'">'.$page.'</a></li>';
                    else
                        echo '<li class="page-item"><a class="page-link" href="update-destinations.php?page='.$page.'">'.$page.'</a></li>';
                }
                ?>
            </ul>
            <a href="javascript:history.back()" type="button" class="btn btn-danger">Back</a>
        </div>
    </div>
</body>
</html>