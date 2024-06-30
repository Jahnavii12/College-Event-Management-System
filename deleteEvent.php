<?php
include_once 'classes/db1.php';

if (isset($_GET['id'])) {
    $event_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete related records from staff_coordinator table
    $delete_staff_sql = "DELETE FROM staff_coordinator WHERE event_id = '$event_id'";
    if ($conn->query($delete_staff_sql) === TRUE) {
        // Then delete the event from events table
        $delete_event_sql = "DELETE FROM events WHERE event_id = '$event_id'";
        if ($conn->query($delete_event_sql) === TRUE) {
            echo "<script>alert('Event deleted successfully!'); window.location.href = 'adminPage.php';</script>";
        } else {
            echo "Error deleting event: " . $conn->error;
        }
    } else {
        echo "Error deleting staff coordinators: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: adminPage.php");
    exit;
}
?>
