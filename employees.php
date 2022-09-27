<?php
session_start();
require_once "./app/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./app/head.php" ?>
    <title>Employees</title>

    <?php require_once "./app/style.php" ?>
</head>

<body>

    <?php require_once "./app/nav.php"; ?>

    <?php
    $result = $mysqli->query("SELECT * FROM projects
                                RIGHT JOIN employees
                                    ON projects.id = employees.project_id
                            ") or die($mysqli->error);
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
            <h3 class="text-center my-4">CRUD Employees</h3>
        </div>
        <div class="mt-5 mb-3">
            <a href="newemployee.php" class="btn btn-primary">Add new Employee</a>
        </div>
        <div>
            <table class="table table-hover table-bordered shadow p-3 mb-3 bg-body rounded">
                <tr class="table-secondary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Project</th>
                    <th>Action</th>
                </tr>
                <?php if (mysqli_num_rows($result) > 0) while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['projectname']; ?></td>
                        <td>
                            <a href="updateEmpl.php?updateEmpl=<?php echo $row['id'] ?>" class="btn btn-outline-primary">Update</a>
                            <a href="delete.php?deleteempl=<?php echo $row['id'] ?>" class="btn btn-outline-danger">Delete</a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <?php require_once "./app/footer.php" ?>

</body>

</html>