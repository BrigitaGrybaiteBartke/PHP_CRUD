<?php

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

// create new employee
if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) and !empty($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $result = $mysqli->query("INSERT INTO employees(name, email) VALUES(\"$name\", \"$email\")") or
            die($mysqli->error);
        header("Location: employees.php");
    } else {
        echo "Input fields are empty";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<body>

    <?php require_once "header.php"; ?>
    <!-- forma -->
    <div class="container">
        <form action="newemployee.php" method="POST">
            <div class="my-3 width">
                <label for="name" class="form-label">Employee's Name</label>
                <input type="text" name="name" placeholder="Enter employee name" class="form-control">
            </div>
            <div class="my-3 width">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" placeholder="Enter employee email address" class="form-control">
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


</body>

</html>