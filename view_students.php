<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <!-- Header content here -->
    </header>
    <div class="container">
        <?php if (empty($students)) { ?>
            <h2>No students registered for selected course unit.</h2>
        <?php } else { ?>
            <h2>Students Registered for selected course unit</h2>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Student Name</th>
                        <th>Registration Number</th>
                        <th>Course</th>
                        <th>Year of Study</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $key => $student) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
                            <td><?php echo $student['registration_number']; ?></td>
                            <td><?php echo $student['course_name']; ?></td>
                            <td><?php echo $student['year_of_study']; ?></td>
                            <td><?php echo $student['semester']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <!-- Other content goes here -->
</body>
</html>
