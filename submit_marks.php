<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: lecturer_login.html');
    exit();
}

// Check if the courseUnitId parameter is provided
if (!isset($_GET['courseUnitId'])) {
    echo "Course unit ID is missing.";
    exit();
}

$courseUnitId = $_GET['courseUnitId'];

// Fetch students who offer the selected course unit from the database
// You need to replace this with your database logic
$students = array(); // Fetch students from the database

// Assuming you have fetched students, you can display them
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Marks</title>
    <style>
        /* Styles here */
    </style>
</head>
<body>
    <header>
        <!-- Header content here -->
    </header>
    <div class="container">
        <h2>Submit Marks for Course Unit</h2>
        <form action="submit_marks_handler.php" method="post">
            <input type="hidden" name="courseUnitId" value="<?php echo $courseUnitId; ?>">
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Marks</th>
                </tr>
                <?php foreach ($students as $student)  ?>
                    <tr>
                        <td><?php echo $student['student_id']; ?></td>
                        <td><?
