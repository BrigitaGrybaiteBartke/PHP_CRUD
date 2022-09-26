<?php
require_once "connect.php";
session_start();

if (isset($_POST['submit'])) {
    if (!empty($_POST['projectName'])) {
        $projectname = $_POST['projectName'];
        $chooseEmpl = $_POST['chooseEmpl'];

        if (isset($chooseEmpl) != NULL) {
            $stmt = $mysqli->prepare("INSERT INTO projects(projectname) VALUES (?)");
        }

        $stmt = $mysqli->prepare("INSERT INTO projects(projectname) VALUES (?)");
        $stmt->bind_param('s', $projectname);
        $stmt->execute();
        printf("%d row inserted.\n", $stmt->affected_rows);
        $stmt->close();

        $_SESSION['message'] = "New project name has been saved!";
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
    <title>New Project</title>

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

    <?php if (isset($_POST['submit']) and empty($_POST['projectName'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div class="text-center mt-5">
            <h3>Create a new Project</h3>
        </div>
        <div class="mt-5">
            <form action="" method="POST">
                <div class="my-3 width">
                    <label for="projectName" class="form-label">Project</label>
                    <input type="text" name="projectName" placeholder="Enter new project name" class="form-control">
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>