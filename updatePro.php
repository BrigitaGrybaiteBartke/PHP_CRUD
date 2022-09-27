<?php
session_start();
require_once "./app/connect.php";

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
    <?php require_once "./app/head.php" ?>

    <title>Update Project</title>

    <?php require_once "./app/style.php" ?>
</head>

<body>
    <?php require_once "./app/nav.php"; ?>

        <!-- Empty input field message -->
    <?php if (isset($_POST['update']) and empty($_POST['projectName'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div class="text-center mt-5">
            <h3>Update Project</h3>
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