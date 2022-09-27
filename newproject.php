<?php
session_start();
require_once "./app/connect.php";

if (isset($_POST['submit'])) {
    if (!empty($_POST['projectName'])) {
        $projectname = $_POST['projectName'];
        
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
<?php require_once "./app/head.php" ?>
    <title>Create new Project</title>

    <?php require_once "./app/style.php" ?>
</head>

<body>

<?php require_once "./app/nav.php"; ?>

<!-- Empty input field message -->
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