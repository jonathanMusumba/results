<?php
session_start();
include 'db_connection.php';

if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM lecturers WHERE username='$username'";
$result = mysqli_query($con, $query);
$lecturer = mysqli_fetch_assoc($result);
$lecturer_id = $lecturer['id'];

$query = "SELECT * FROM lecturercourseunits WHERE lecturer_id=$lecturer_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results</title>
</head>
<body>
    <h2>Student Results</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Course Unit</th>
            <th>Coursework</th>
            <th>Test</th>
            <th>Exam</th>
            <th>Total</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <?php
            $course_unit_id = $row['course_unit_id'];
            $semester_id = $row['semester_id'];
            $query = "SELECT * FROM results WHERE course_unit_id=$course_unit_id AND semester_id=$semester_id";
            $results = mysqli_query($con, $query);
            while($result_row = mysqli_fetch_assoc($results)): ?>
                <tr>
                    <td><?php echo $result_row['student_id']; ?></td>
                    <td><?php echo $row['course_unit_id']; ?></td>
                    <td><?php echo $result_row['coursework']; ?></td>
                    <td><?php echo $result_row['test']; ?></td>
                    <td><?php echo $result_row['exam']; ?></td>
                    <td><?php echo $result_row['total']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endwhile; ?>
    </table>
</body>
</html>
