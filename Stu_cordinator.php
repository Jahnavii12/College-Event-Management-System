<?php
include_once 'classes/db1.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Query to get events with student coordinators
$result = mysqli_query($conn, "SELECT * FROM events WHERE student_coordinator IS NOT NULL");

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest - Student Coordinators</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
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

        .btn-primary {
            background-color: #2E5A88;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-primary:active {
            background-color: #0056b3;
        }

        .btn-primary:focus {
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>
    

    <div class="content">
        <div class="container">
            <h1>Student Co-ordinator Details</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Event Title</th>
                        <th>Student Co-ordinator</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row["event_title"]; ?></td>
                                <td><?php echo $row["student_coordinator"]; ?></td>
                                <td>
                                    <a href="updateStudent.php?id=<?php echo $row['event_id']; ?>" class="btn btn-primary">Update</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="3">No results found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
