<?php
include_once 'classes/db1.php';

// Initialize variables for messages
$success_message = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['event_id'], $_POST['first_place'], $_POST['second_place'], $_POST['third_place'])) {
        $event_id = $_POST['event_id'];
        $first_place = $_POST['first_place'];
        $second_place = $_POST['second_place'];
        $third_place = $_POST['third_place'];

        // Check if the event_id exists in the events table
        $check_sql = "SELECT * FROM events WHERE event_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $event_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Insert new results into the results table
            $insert_sql = "INSERT INTO results (event_id, first_place, second_place, third_place) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);

            if ($insert_stmt) {
                $insert_stmt->bind_param("isss", $event_id, $first_place, $second_place, $third_place);

                if ($insert_stmt->execute()) {
                    $success_message = "Results inserted successfully.";
                    // Redirect to adminPage.php after successful insertion
                    header("Location: adminPage.php");
                    exit(); // Ensure script stops here and doesn't continue
                } else {
                    $error_message = "Error inserting results: " . $insert_stmt->error;
                }

                $insert_stmt->close();
            } else {
                $error_message = "Prepare statement failed: " . $conn->error;
            }
        } else {
            $error_message = "Event ID does not exist.";
        }

        $check_stmt->close();
    } else {
        $error_message = "All fields are required.";
    }
}

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Event Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #0b0b45;
            margin-bottom: 30px;
        }

        .alert {
            margin-top: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0b0b45;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Event Results</h2>
                <?php if (!empty($success_message)) : ?>
                    <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label for="event_id">Event ID:</label>
                        <input type="text" class="form-control" id="event_id" name="event_id" required>
                    </div>
                    <div class="form-group">
                        <label for="first_place">First Place:</label>
                        <input type="text" class="form-control" id="first_place" name="first_place" required>
                    </div>
                    <div class="form-group">
                        <label for="second_place">Second Place:</label>
                        <input type="text" class="form-control" id="second_place" name="second_place" required>
                    </div>
                    <div class="form-group">
                        <label for="third_place">Third Place:</label>
                        <input type="text" class="form-control" id="third_place" name="third_place" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
