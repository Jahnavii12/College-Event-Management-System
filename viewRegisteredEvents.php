<?php
// Include database connection or any necessary files
include_once 'classes/db1.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Retrieve events registered by the user
$username = $_SESSION["username"];
$result = mysqli_query($conn, "SELECT * FROM events WHERE registered_user = '$username'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Registered Events</title>
    <!-- Include any necessary CSS -->
</head>
<body>
    <!-- Include header or navigation if needed -->

    <div class="container">
        <h2>Registered Events</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row["event_title"]."</td>";
                        echo "<td>".$row["date"]."</td>";
                        // Display more event details as needed
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No events registered.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include footer or any necessary scripts -->
</body>
</html>

<?php
// Close the database connection if needed
mysqli_close($conn);
?>
