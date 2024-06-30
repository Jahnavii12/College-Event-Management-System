<?php
include_once 'classes/db1.php';
$result = mysqli_query($conn, "SELECT * FROM events");

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest</title>
    <style>
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
        .btn-default {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-default:hover {
            background-color: #0056b3;
        }
        .delete {
            color: red;
        }

        .delete:hover {
            text-decoration: none;
            color: darkred;
        }
        </style>
</head>

<body>
    <?php include 'utils/adminHeader.php'?>


    <div class="content">
    <div class="container mt-4">
        <h1 class="mb-4">Event Details</h1>
        <?php
        if (mysqli_num_rows($result) > 0) {
        ?>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Event Name</th>
                        <th>Price</th>
                        <th>Student Coordinator</th>
                        <th>Staff Coordinator</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['event_title'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>' . $row['student_coordinator'] . '</td>';
                        echo '<td>' . $row['staff_coordinator'] . '</td>';
                        echo '<td>' . $row['Date'] . '</td>';
                        echo '<td>' . $row['time'] . '</td>';
                        echo '<td>' . $row['location'] . '</td>';
                        echo '<td>'
                            . '<a class="delete" href="deleteEvent.php?id=' . $row['event_id'] . '">Delete</a> '
                            . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p>No events found.</p>";
        }
        ?>
        <a class="btn btn-primary mt-3" href="createEventForm.php">Create Event</a>
    </div>
</div>


    <?php require 'utils/footer.php'; ?>
</body>

</html>
