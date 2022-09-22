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
    // connection to server
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    // selection
    $result = $mysqli->query("SELECT * FROM projects") or die($mysqli->error);
    ?>

    <div class="container">
        <div class="mt-5">
            <a href="newproject.php" class="btn btn-primary">Add new Project</a>
        </div>
        <div>
            <div>
                <h3 class="text-center mt-3 mb-4">Project management system</h3>
            </div>
            <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded">
                <tr class="table-secondary">
                    <th>Id</th>
                    <th>Project Name</th>
                    <th>Action</th>
                </tr>
                <?php if (mysqli_num_rows($result) > 0) while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['projectname']; ?></td>
                        <td>
                            <a href="" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile;  ?>
            </table>
        </div>
    </div>

</body>

</html>