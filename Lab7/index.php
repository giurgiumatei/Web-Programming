<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab7</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once 'process.php'?>

    <?php
        if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            header("Refresh:1");
        ?>
    </div>
    <?php endif ?>
    <div class = "container">
    <?php
        $mysqli = new mysqli('localhost','matei','mamaligacutocana', 'vacation') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);// un obiect care are numai date legate de array, nu itemele
      //  $result->fetch_asoc();// cu asta luam pe rand row-urile din tabel, la fiecare apel luam urmatorul row
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>City</th>
                    <th>Country</th>
                    <th>Description</th>
                    <th>Targets</th>
                    <th>Cost</th>
                    <th colspan="5">Action</th>
                </tr>
            </thead>
            <?php
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['targets']; ?></td>
                    <td><?php echo $row['cost']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control"
                       value="<?php echo $city; ?>" placeholder="Enter a city " >
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" value="<?php echo $country; ?>"
                       class="form-control" placeholder="Enter a country" >
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $description; ?>"
                       class="form-control" placeholder="Enter a description" >
            </div>
            <div class="form-group">
                <label>Tourist Targets</label>
                <input type="text" name="targets" value="<?php echo $targets; ?>"
                       class="form-control" placeholder="Enter some targets" >
            </div>
            <div class="Estimated cost per day">
                <label>Estimated Cost</label>
                <input type="text" name="cost" value="<?php echo $cost; ?>"
                       class="form-control" placeholder="Enter a cost" >
            </div>
            <div class="form-group">
                <?php
                    if ($update == true):
                ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif;?>
            </div>


        </form>
    </div>
    </div>
</body>

