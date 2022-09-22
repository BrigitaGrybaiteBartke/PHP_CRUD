<?php
require_once "connect.php";

// echo "<br>";
// var_dump($_POST['projectName']);

if (isset($_POST['submit'])) {
    $project_name = $_POST['projectName'];

    $sql = "INSERT INTO projects(project_name) VALUES($project_name)";
    $result = mysqli_query($con, $sql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <?php require_once "header.php"; ?>


    <div class="container">
        <form action="" method="POST">
            <div class="my-3">
                <label for="projectName" class="form-label">Project</label>
                <input type="text" name="projectName" placeholder="Enter new project name" class="form-control">
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container">
        <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded">
            <tr class="table-secondary">
                <th>Id</th>
                <th>Project Name</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM projects";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $project_name = $row['project_name'];
                    echo "<tr>
                                <td>$id</td>
                                <td>$project_name</td>
                                <td>
                                    <a href=\"\" class=\"btn btn-outline-primary\">Edit</a>
                                    <a href=\"\" class=\"btn btn-outline-danger\">Delete</a>
                                </td>
                         </tr>";
                }
            } else {
                echo "<span>No results found!</span>";
            };
            mysqli_close($con);
            ?>


        </table>
    </div>



</body>

</html>