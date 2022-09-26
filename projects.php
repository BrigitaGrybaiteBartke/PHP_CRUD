<?php
session_start();
require_once "connect.php";
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

    <?php
    // selection
    $result = $mysqli->query("SELECT projects.id, projectname, group_concat(name SEPARATOR ' / ') as names FROM projects
                                LEFT JOIN employees
                                    ON projects.id = employees.project_id
                                GROUP BY projectname
                                ORDER BY id ")
        or die($mysqli->error);
    ?>

    <!-- create / delete / update message -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div>
            <h3 class="text-center my-4">Project management system</h3>
        </div>
        <div class="mt-5 mb-3">
            <a href="newproject.php" class="btn btn-primary">Add new Project</a>
        </div>
        <div>


            <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded">
                <tr class="table-secondary">
                    <th>Id</th>
                    <th>Project Name</th>
                    <th>Employees</th>
                    <th>Action</th>
                </tr>
                <?php if ($result->num_rows > 0) while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['projectname'] ?></td>
                        <td><?php echo $row['names'] ?></td>
                        <td>
                            <a href="updatePro.php?updatePro=<?php echo $row['id'] ?>" class="btn btn-outline-primary">Update</a>
                            <a href="delete.php?delete=<?php echo $row['id'] ?>" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile;  ?>
            </table>
        </div>
    </div>

</body>

</html>