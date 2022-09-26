<?php

require_once "connect.php";
session_start();

// create new employee
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
        echo "Input fields are empty";
    }
}

// jeigu projekto id yra ne null
// paruosti uzklausa su mysql irasant kad butu pridetas ir projekto id
// uzbaindinti projekto id



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <!-- forma -->
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
                <!-- <label for="chooseProject">Choose Project (optional)</label> -->
                <select name="chooseProject">
                    <option value="" selected>Choose Project</option>
                    <?php 
                        $result = $mysqli->query("SELECT projectname, id FROM projects") or die($mysqli->error);
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