<?php

session_start();

// echo "<pre>";
// var_dump($_GET['delete'])

// connection to server
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli -> query("DELETE FROM projects WHERE id=$id") or die($mysqli_error($mysqli));

    $_SESSION['message'] = "Project has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("Location: projects.php");
}

?>
