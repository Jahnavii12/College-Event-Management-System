<?php
include_once 'classes/db1.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Check if event ID is provided
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    header("location: events.php");
    exit;
}

// Get event ID from the URL
$event_id = trim($_GET['id']);

// Initialize variables for event details
$event_title = "";
$event_price = "";

// Prepare and execute SQL to get event details
$sql = "SELECT event_title, price FROM events WHERE event_id = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare was successful
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch event details
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $event_title = $row['event_title'];
    $event_price = $row['price'];
} else {
    // Redirect if event not found
    header("location: events.php");
    exit;
}

$stmt->close();

// Initialize variables for form submission
$usn = $name = $branch = $sem = $email = $phone = $college = "";
$registration_err = $registration_success = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["id"];
    $usn = trim($_POST["usn"]);
    $name = trim($_POST["name"]);
    $branch = trim($_POST["branch"]);
    $sem = trim($_POST["sem"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $college = trim($_POST["college"]);

    // Validate form fields
    if (empty($usn) || empty($name) || empty($branch) || empty($sem) || empty($email) || empty($phone)) {
        $registration_err = "Please fill in all fields.";
    } else {
        // Check if user already registered
        $sql_check = "SELECT * FROM event_registrations WHERE event_id = ? AND user_id = ?";
        $stmt_check = $conn->prepare($sql_check);

        // Check if the prepare was successful
        if (!$stmt_check) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt_check->bind_param("ii", $event_id, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // User is already registered for the event
            $registration_err = "You are already registered for this event.";
        } else {
            // Insert into event_registrations table
            $sql_register_event = "INSERT INTO event_registrations (event_id, user_id) VALUES (?, ?)";
            $stmt_register_event = $conn->prepare($sql_register_event);

            // Check if the prepare was successful
            if (!$stmt_register_event) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }

            $stmt_register_event->bind_param("ii", $event_id, $user_id);
            
            if ($stmt_register_event->execute()) {
                // Get the generated participant ID
                $participant_id = $stmt_register_event->insert_id;

                // Insert into participant table
                $sql_register_participant = "INSERT INTO participant (participant_id, usn, name, branch, sem, email, phone, college) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_register_participant = $conn->prepare($sql_register_participant);

                // Check if the prepare was successful
                if (!$stmt_register_participant) {
                    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                }

                $stmt_register_participant->bind_param("isssssss", $participant_id, $usn, $name, $branch, $sem, $email, $phone, $college);
                
                if ($stmt_register_participant->execute()) {
                    // Registration successful
                    $registration_success = "You have successfully registered for '$event_title'!";
                    // Redirect to registeredEvents.php after successful registration
                    header("location: registeredEvents.php");
                    exit;
                } else {
                    // Registration failed
                    $registration_err = "Registration failed: (" . $stmt_register_participant->errno . ") " . $stmt_register_participant->error;
                }

                $stmt_register_participant->close();
            } else {
                // Registration failed
                $registration_err = "Registration failed: (" . $stmt_register_event->errno . ") " . $stmt_register_event->error;
            }

            $stmt_register_event->close();
        }

        $stmt_check->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register for Event: <?php echo htmlspecialchars($event_title); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h2>Register for Event: <?php echo htmlspecialchars($event_title); ?></h2>
                <h3>Price: <?php echo htmlspecialchars($event_price); ?></h3>
                <?php
                if (!empty($registration_success)) {
                    echo '<div class="alert alert-success" role="alert">' . $registration_success . '</div>';
                    echo '<a href="registeredEvents.php" class="btn btn-primary">View Registered Events</a>';
                }
                if (!empty($registration_err)) {
                    echo '<div class="alert alert-danger" role="alert">' . $registration_err . '</div>';
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $event_id; ?>" method="post">
                    <div class="form-group">
                        <label for="usn">USN (Unique Student Number)</label>
                        <input type="text" class="form-control" id="usn" name="usn" placeholder="Enter USN" value="<?php echo htmlspecialchars($usn); ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo htmlspecialchars($name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Enter Branch" value="<?php echo htmlspecialchars($branch); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sem">Semester</label>
                        <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester" value="<?php echo htmlspecialchars($sem); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($phone); ?>">
                    </div>
                    <div class="form-group">
                        <label for="college">College Name</label>
                        <input type="text" class="form-control" id="college" name="college" placeholder="Enter College Name" value="<?php echo htmlspecialchars($college); ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Register">
                    <a href="events.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
