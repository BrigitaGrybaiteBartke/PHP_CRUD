<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

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

    <?php
    // connection to server
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    // selection
    $result = $mysqli->query("SELECT * FROM employees") or die($mysqli->error);
    ?>

    <div class="container">
        <div class="mt-5">
            <a href="newemployee.php" class="btn btn-primary">Add new Employee</a>
        </div>
        <div>
            <div>
                <h3 class="text-center mt-3 mb-4">Employee management system</h3>
            </div>
            <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded">
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Action</td>
                </tr>
                <?php if (mysqli_num_rows($result) > 0) while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="" class="btn btn-outline-primary">Edit</a>
                            <a href="" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>



</body>

</html>