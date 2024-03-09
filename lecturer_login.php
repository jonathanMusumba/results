<?php
session_start();
include 'db_connection.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM lecturers WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header('Location: lecturer_dashboard.php'); // Redirect to lecturer dashboard
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header('Location: lecturer_login.html'); // Redirect back to lecturer login form
        exit();
    }
}
?>
