<?php
include_once 'classes/db1.php';

// Retrieve event results from the database
$sql = "SELECT event_title, first_place, second_place, third_place FROM results INNER JOIN events ON results.event_id = events.event_id WHERE first_place IS NOT NULL";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #0b0b45;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #0b0b45;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #0b0b45;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-primary:focus {
            background-color: #0056b3;
            box-shadow: none;
        }

        .btn-primary:active {
            background-color: #0056b3;
        }

        .btn-primary:disabled {
            background-color: #ccc;
        }

        .btn-primary:disabled:hover {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Event Results</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>First Place</th>
                            <th>Second Place</th>
                            <th>Third Place</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are rows returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['event_title'] . "</td>";
                                echo "<td>" . $row['first_place'] . "</td>";
                                echo "<td>" . $row['second_place'] . "</td>";
                                echo "<td>" . $row['third_place'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No results available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>
