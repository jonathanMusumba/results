<?php
session_start();
include 'db_connection.php';

if(isset($_POST['login'])) {
    $registration_number = $_POST['registration_number'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM studentlogin WHERE registration_number='$registration_number' AND password='$password'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $_SESSION['registration_number'] = $registration_number;
        header('Location: student_dashboard.php');
    } else {
        echo "Invalid registration number or password";
    }
}
?>
