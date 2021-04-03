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
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
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
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                       value="<?php echo $name; ?>" placeholder="Enter your name" >
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="<?php echo $location; ?>"
                       class="form-control" placeholder="Enter your location" >
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

