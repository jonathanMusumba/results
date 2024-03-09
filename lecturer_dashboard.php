<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            font-weight: bold;
        }
        select {
            padding: 8px;
            width: 100%;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .recent-logins {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .summary-table-container {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Left side navigation styles */
        .sidenav-left {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidenav-left a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #818181;
            display: block;
            transition: color 0.3s;
            margin-bottom: 10px;
        }
        .sidenav-left a:hover {
            color: white;
        }
        /* Right side navigation styles */
        .sidenav-right {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidenav-right .recent-logins {
            color: #818181;
            font-size: 16px;
            margin: 0 15px; /* Add margin to the recent logins */
        }
        .sidenav-right .recent-logins h3 {
            color: white;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Left side navigation -->
    <div class="sidenav-left">
        <a href="#">Results</a>
        <a href="#">Course Units</a>
        <a href="#">Students</a>
        <a href="portal.html">Logout</a>
    </div>

    <!-- Main content -->
    <div class="container">
        <h2>Courses</h2>
        <form id="courseSelectionForm">
            <label for="courseUnit">Select Course Unit:</label>
            <select id="courseUnit" name="courseUnit">
                <option value="">Select Course Unit</option>
                <?php
                session_start(); // Start session
                include 'db_connection.php'; // Include database connection

                // Check if username is set in session
                if(isset($_SESSION['username'])) {
                    // Fetch course units for the current lecturer
                    $username = $_SESSION['username'];
                    $query = "SELECT lc.id, cu.name 
                              FROM lecturercourseunits lc 
                              INNER JOIN courseunits cu ON lc.course_unit_id = cu.id 
                              INNER JOIN lecturers l ON lc.lecturer_id = l.id 
                              WHERE l.username = '$username'";
                    $result = mysqli_query($con, $query);

                    // Display course unit options
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </form>
        <div id="options">
            <h3>Options</h3>
            <button id="viewStudentsBtn">View Students</button>
            <button id="submitMarksBtn">Submit Marks</button>
        </div>
    </div>

    <!-- Right side navigation -->
    <div class="sidenav-right">
        <div class="recent-logins">
            <h3>Recent Logins</h3>
            <!-- PHP logic to fetch and display recent logins -->
            <?php
            // Database connection
            include 'db_connection.php';

            // Fetch recent logins from lecturersession table
            $query = "SELECT * FROM lecturersession ORDER BY login_time DESC LIMIT 5";
            $result = mysqli_query($con, $query);

            // Display recent logins
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>Login Time: " . $row['login_time'] . "</p>";
                    echo "<p>Duration: " . $row['duration'] . "</p>";
                    echo "<p>Location: " . $row['location'] . "</p>";
                    echo "<hr>"; // Add horizontal line for separation
                }
            } else {
                echo "<p>No recent logins</p>";
            }

            // Close database connection
            mysqli_close($con);
            ?>
        </div>
    </div>

    <!-- JavaScript code for button actions -->
    <script>
        document.getElementById('courseUnit').addEventListener('change', function() {
            var courseUnitId = this.value;
            if (courseUnitId !== '') {
                document.getElementById('options').style.display = 'block';
            } else {
                document.getElementById('options').style.display = 'none';
            }
        });

        document.getElementById('viewStudentsBtn').addEventListener('click', function() {
            var courseUnitId = document.getElementById('courseUnit').value;
            if (courseUnitId !== '') {
                window.location.href = 'view_students.php?courseUnitId=' + courseUnitId;
            }
        });

        document.getElementById('submitMarksBtn').addEventListener('click', function() {
            var courseUnitId = document.getElementById('courseUnit').value;
            if (courseUnitId !== '') {
                window.location.href = 'submit_marks.php?courseUnitId=' + courseUnitId;
            }
        });
    </script>
</body>
</html>
