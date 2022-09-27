<?php
session_start();
require_once "./app/connect.php";

// Project delete logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $mysqli->prepare("DELETE FROM projects WHERE id=?") or die($mysqli_error($mysqli));
    $stmt->bind_param('i', $id);
    $id = $_GET['delete'];
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Project has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("Location: projects.php");
}


// Employee delete logic
if (isset($_GET['deleteempl'])) {
    $id = $_GET['deleteempl'];
    $stmt = $mysqli->prepare("DELETE FROM employees WHERE id=?") or die($mysqli_error($mysqli));
    $stmt->bind_param('i', $id);
    $id = $_GET['deleteempl'];
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Employee has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("Location: employees.php");
}
