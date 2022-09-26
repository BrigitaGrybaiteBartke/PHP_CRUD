<?php
session_start();
require_once "connect.php";

$idEmpl = $_GET['updateEmpl'];
$result = $mysqli->query("SELECT * FROM employees WHERE id=\"$idEmpl\"") or die($mysqli->error);
$row = $result->fetch_assoc();
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$project_id = $row['project_id'];


if (isset($_POST['update'])) {
    if (!empty($_POST['name']) and !empty($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $chooseProject = $_POST['chooseProject'];

        if ($chooseProject != NULL) {
            $stmt = $mysqli->prepare("UPDATE employees SET name=?, email=?, project_id=? WHERE id=?");
            $stmt->bind_param('ssii', $name, $email, $chooseProject, $idEmpl);
        } else {
            $stmt = $mysqli->prepare("UPDATE employees SET name=?, email=? WHERE id=?");
            $stmt->bind_param('ssi', $name, $email, $idEmpl);
        }

        $stmt->execute();
        $stmt->close();
        $_SESSION['message'] = "Employee data has been updated!";
        $_SESSION['msg_type'] = "warning";

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

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


    <style>
        .width {
            width: 300px;
        }
    </style>

</head>

<body>

    <?php require_once "header.php"; ?>
    <!-- forma -->
    <div class="container">
        <form action="" method="POST">
            <div class="my-3 width">
                <label for="name" class="form-label">Employee's Name</label>
                <input value="<?php echo $name ?>" type="text" name="name" placeholder="Enter employee name" class="form-control width">
            </div>
            <div class="my-3 width">
                <label for="email" class="form-label">Email</label>
                <input value="<?php echo $email ?>" type="text" name="email" placeholder="Enter employee email address" class="form-control width">
            </div>
            <div class="my-3 width">
                <!-- selection -->
                <select name="chooseProject">
                    <option value="" selected>Choose Project</option>
                    <?php
                    $result = $mysqli->query("SELECT projectname, id FROM projects") or die($mysqli->error);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {  ?>
                            <option value="<?php echo $row['id'], $row['projectname'] ?>"><?php echo $row['projectname']; ?></option>
                    <?php }
                    } ?>
                </select>
                <span>*optional</span>

            </div>
            <div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>


</body>

</html>