<?php
// connection
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

// create new project
if (isset($_POST['submit'])) {
    if (!empty($_POST['projectName'])) {
        $projectname = $_POST['projectName'];
        $result = $mysqli->query("INSERT INTO projects(projectname) VALUES(\"$projectname\")") or
            die($mysqli->error);
            header("Location: projects.php");
    } else {
        echo "Empty project input field";
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

    <div class="container">
        <div class="text-center mt-5">
            <h3>Create a new Project</h3>
        </div>
        <div class="mt-5">
            <form action="newproject.php" method="POST">
                <div class="my-3 width">
                    <label for="projectName" class="form-label">Project</label>
                    <input type="text" name="projectName" placeholder="Enter new project name" class="form-control">
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>