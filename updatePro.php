<?php
session_start();
require_once "connect.php";

// update logic
$id = $_GET['updatePro'];
$result = $mysqli->query("SELECT * FROM projects WHERE id=\"$id\"") or die($mysqli->error);
$row = $result->fetch_assoc();
$id = $row['id'];
$projectname = $row['projectname'];

if (isset($_POST['update'])) {
    if (!empty($_POST['projectName'])) {
        $projectname = $_POST['projectName'];
        $stmt = $mysqli->prepare("UPDATE projects SET projectname=? WHERE id=?");
        $stmt->bind_param('si', $projectname, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Project name has been updated!";
        $_SESSION['msg_type'] = "success";

        header("Location: projects.php");
    } else {
        $_SESSION['message'] = "Empty input field!";
        $_SESSION['msg_type'] = "danger";
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

    <?php require_once "header.php" ?>

    <?php if (isset($_POST['update']) and empty($_POST['projectName'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div class="text-center mt-5">
            <h3>Update Project name</h3>
        </div>
        <div class="mt-5">
            <form action="" method="POST">
                <div class="my-3 width">
                    <label for="projectName" class="form-label">Project</label>
                    <input value="<?php echo $projectname ?>" type="text" name="projectName" class="form-control">
                </div>
                <div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>