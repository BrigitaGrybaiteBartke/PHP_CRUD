<?php
session_start();
require_once "./app/connect.php";
?>

<?php
    $result = $mysqli->query("SELECT projects.id, projectname, group_concat(name SEPARATOR ' / ') as names FROM projects
                                LEFT JOIN employees
                                    ON projects.id = employees.project_id
                                GROUP BY projectname
                                ORDER BY id ")
        or die($mysqli->error);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./app/head.php" ?>

    <title>Projects</title>
    
    <?php require_once "./app/style.php" ?>
</head>

<body>
    <?php require_once "./app/nav.php"; ?>

    <!-- create / delete / update message -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div>
            <h3 class="text-center my-4">CRUD Projects</h3>
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

    <?php require_once "./app/footer.php" ?>

</body>
</html>