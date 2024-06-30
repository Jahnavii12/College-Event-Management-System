<?php
include_once 'classes/db1.php';

// Check if user is logged in as admin
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Fetch participant data
$result = mysqli_query($conn, "SELECT * FROM participant");

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest - Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #0B0B45;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto; /* Center the table */
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #0B0B45;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    
    
    <div class="content">
        <div class="container">
            <h1>Student Details</h1>

            <!-- Display participant data -->
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <table class="table table-hover">
                    <tr>
                        <th>USN</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Semester</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>College</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?php echo $row["usn"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["branch"]; ?></td>
                            <td><?php echo $row["sem"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["phone"]; ?></td>
                            <td><?php echo $row["college"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else : ?>
                <p>No participants found.</p>
            <?php endif; ?>
        </div>
    </div>

    
</body>

</html>
