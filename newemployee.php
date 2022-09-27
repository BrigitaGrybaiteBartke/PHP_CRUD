<?php
session_start();
require_once "./app/connect.php";

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) and !empty($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $chooseProject = $_POST['chooseProject'];
        
        if($chooseProject != NULL) {
            $stmt = $mysqli->prepare("INSERT INTO employees(name, email, project_id) VALUES(?, ?, ?)");
            $stmt->bind_param('ssi', $name, $email, $chooseProject);
        } else {
            $stmt = $mysqli->prepare("INSERT INTO employees(name, email) VALUES(?, ?)");
            $stmt->bind_param('ss', $name, $email);
        }
        
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "New employee has been saved!";
        $_SESSION['msg_type'] = "success";

        header("Location: employees.php");
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
    <title>Create new employee</title>
    
    <?php require_once "./app/style.php" ?>

<?php require_once "./app/nav.php"; ?>

<!-- Empty input field message -->
<?php if (isset($_POST['submit']) and empty($_POST['name']) and empty($_POST['email'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']) ?>
        </div>
    <?php endif ?>


    <div class="container">
        <form action="newemployee.php" method="POST">
            <div class="my-3 width">
                <label for="name" class="form-label">Employee's Name</label>
                <input type="text" name="name" placeholder="Enter employee name" class="form-control width">
            </div>
            <div class="my-3 width">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" placeholder="Enter employee email address" class="form-control width">
            </div>
            <div class="my-3 width">
                <select name="chooseProject">
                    <option value="" selected>Choose Project</option>
                    <?php 
                        $result = $mysqli->query("SELECT DISTINCT projectname, id FROM projects") or die($mysqli->error);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {  ?>
                      <option value="<?php echo $row['id'], $row['projectname'] ?>"><?php echo $row['projectname']; ?></option>
                    <?php }} ?>        
                </select>
                <span>*optional</span>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>