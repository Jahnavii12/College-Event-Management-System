<?php
include_once 'classes/db1.php';

if (isset($_POST["submit"])) {
    if (!empty($_POST['type_id']) && !empty($_POST['title']) && !empty($_POST['price']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['location']) && !empty($_POST['image_link']) && !empty($_POST['staff_coordinator']) && !empty($_POST['student_coordinator'])) {

        $type_id = mysqli_real_escape_string($conn, $_POST['type_id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $image_link = mysqli_real_escape_string($conn, $_POST['image_link']);
        $staff_coordinator = mysqli_real_escape_string($conn, $_POST['staff_coordinator']);
        $student_coordinator = mysqli_real_escape_string($conn, $_POST['student_coordinator']);

        $sql = "INSERT INTO events (type_id, event_title, price, Date, time, location, image_link, staff_coordinator, student_coordinator) 
                VALUES ('$type_id', '$title', '$price', '$date', '$time', '$location', '$image_link', '$staff_coordinator', '$student_coordinator')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Event created successfully!');</script>";
            echo "<script>window.location.href = 'adminPage.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('All fields are required');</script>";
        echo "<script>window.location.href = 'createEventForm.php';</script>";
        exit();
    }
} else {
    echo "<script>window.location.href = 'createEventForm.php';</script>";
    exit();
}

$conn->close();
?>
