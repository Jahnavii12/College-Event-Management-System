<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Include the database connection file
include_once 'classes/db1.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the form data into the database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            // Send email to admin
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';  // SMTP host for Gmail
                $mail->SMTPAuth   = true;
                $mail->Username   = 'aminjahnavi004@gmail.com'; // Your Gmail username
                $mail->Password   = 'gkde mpog iatl fbpr';         // Your Gmail password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                //Recipients
                $mail->setFrom($email, $name); // Sender's email and name
                $mail->addAddress('aminjahnavi004@gmail.com', 'Admin'); // Admin's email

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body    = "Name: $name <br>Email: $email  <br>Message: $message";

                $mail->send();
                echo "<script>alert('Thank you! Your message has been submitted.'); window.location.href = 'index.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'contact.php';</script>";
            }

        } else {
            echo "<script>alert('Oops! Something went wrong and we couldn't submit your message.'); window.location.href = 'contact.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Oops! Something went wrong and we couldn't prepare the statement.'); window.location.href = 'contact.php';</script>";
    }
} else {
    // If the form was not submitted, redirect back to the contact form
    header("Location: contact.php");
    exit;
}

// Close the database connection
$conn->close();
?>
