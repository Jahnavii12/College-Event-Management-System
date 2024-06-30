<?php
include_once 'classes/db1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_feedback"])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and execute SQL to insert feedback into database
    $sql = "INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Feedback submitted successfully
        echo "<script>alert('Thank you for your feedback!'); window.location.href = 'index.php';</script>";
    } else {
        // Error submitting feedback
        echo "<script>alert('Error submitting feedback. Please try again later.'); window.location.href = 'feedback_form.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
