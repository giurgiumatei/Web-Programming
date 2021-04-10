<?php
require 'db_connection.php';

$page_selected = 1;
if (isset ($_REQUEST['page'])) {
    $page_selected = $_GET['page'];
}

$results_per_page = 4;
if (is_numeric($page_selected)){
    $page_first_result = ($page_selected - 1) * $results_per_page;



    if(isset($_REQUEST["term"])){
        $sql = "SELECT * FROM data WHERE country LIKE ?";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s",$param_term);

            $param_term = $_REQUEST["term"] . '%';

            if($stmt->execute()){
                $result = $stmt->get_result();
                $number_of_result = $result->num_rows;

                $number_of_page = ceil ($number_of_result / $results_per_page);

                $query = "SELECT * FROM data WHERE country LIKE '$param_term' LIMIT " . $page_first_result . ',' . $results_per_page;

                $new_result = $mysqli->query($query);

                echo '<ul class="list-group">';
                if(mysqli_num_rows($new_result) > 0){
                    while($row = $new_result->fetch_array(MYSQLI_ASSOC)){
                        echo "<li class='list-group-item'>" . $row["city"] . ' ' . $row['cost'] . "</li>";
                    }
                } else{
                }
                echo '</ul>';
                echo '<ul class="pagination mt-10">';
                for($page = 1; $page<= $number_of_page; $page++) {
                    if($page == $page_selected)
                        echo '<li class="page-item active"><p class="page-link" id="'.$page.'">'.$page.'</p></li>';
                    else
                        echo '<li class="page-item"><p class="page-link" id="'.$page.'">'.$page.'</p></li>';
                }
                echo '</ul>';
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            $stmt->close();
        }

    }
}

?>
