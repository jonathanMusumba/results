<?php
include 'db_connection.php';

$query = "SELECT * FROM students";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
</head>
<body>
    <h2>All Students</h2>
    <table>
        <tr>
            <th>Registration Number</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Year of Study</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['registration_number']; ?></td>
                <td><?php echo $row['first_name'] . " " . $row['other_name']; ?></td>
                <td><?php echo $row['sex']; ?></td>
                <td><?php echo $row['date_of_birth']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['year_of_study']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
