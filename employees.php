<?php
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

    <style>
        .width {
            width: 300px;
        }
    </style>
</head>

<body>

    <?php require_once "header.php"; ?>


    <div class="container">
        <form action="" method="POST">
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

    <div class="container">
        <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded mt-5">
            <tr class="table-secondary">
                    <th>Id</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM employees";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];

                    echo "<tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$email</td>
                        <td>
                            <a href=\"\" class=\"btn btn-outline-primary\">Edit</a>
                            <a href=\"\" class=\"btn btn-outline-danger\">Delete</a>
                        </td>
                    </tr>";
                }
            }

            ?>

        </table>
    </div>


</body>

</html>