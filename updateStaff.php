<?php
include_once 'classes/db1.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // If no ID is provided, redirect back to the page
    header("location: Staff_coordinator.php");
    exit;
}

// Retrieve existing student coordinator details
$result = mysqli_query($conn, "SELECT * FROM events WHERE event_id = '$id'");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $event_title = $row['event_title']; // Get the event title
} else {
    // Handle error if query fails
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Insert into staff coordinator table
if (isset($_POST["update"])) {
    $name = $_POST["name"];

    // Validate input
    if (empty($name)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Update student coordinator name in events table
        $update_event_sql = "UPDATE events SET staff_coordinator = '$name' WHERE event_id = '$id'";
        if ($conn->query($update_event_sql) === false) {
            echo "<script>alert('Error updating staff coordinator name in events table.');</script>";
            exit;
        }

        // Check if student coordinator already exists
        $check_student_sql = "SELECT * FROM staff_coordinator WHERE event_id = '$id'";
        $check_result = mysqli_query($conn, $check_student_sql);
        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Update student coordinator name in student_coordinator table
            $update_student_sql = "UPDATE student_coordinator SET name = '$name' WHERE event_id = '$id'";
            if ($conn->query($update_student_sql) === true) {
                echo "<script>alert('Updated Successfully');</script>";
                header("location: Staff_coordinator.php");
                exit;
            } else {
                echo "<script>alert('Error updating staff coordinator name in staff_coordinator table.');</script>";
                exit;
            }
        } else {
            // Insert student coordinator name into student_coordinator table
            $insert_student_sql = "INSERT INTO staff_coordinator (name, event_id) VALUES ('$name', '$id')";
            if ($conn->query($insert_student_sql) === true) {
                echo "<script>alert('Inserted Successfully');</script>";
                header("location: Staff_coordinator.php");
                exit;
            } else {
                echo "<script>alert('Error inserting staff coordinator name into staff_coordinator table.');</script>";
                exit;
            }
        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest - Update Staff Coordinator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 20px;
            justify-content: center;
            align-items: center;
            margin:0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #0b0b45;
            text-align: center;
            margin-bottom: 20px;

        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-default {
            background-color: #0b0b45;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: center;
        }

        .btn-default:hover {
            background-color: #0056b3;
        }

        .btn-default:active {
            background-color: #0056b3;
        }

        .btn-default:focus {
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>
    

    <div class="content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h2>Update Staff Coordinator</h2>
                <form method="POST">
                    <label>Event Title:</label><br>
                    <input type="text" name="event_title" value="<?php echo $event_title; ?>" disabled class="form-control"><br>
                    <label>Staff Coordinator Name:</label><br>
                    <input type="text" name="name" required class="form-control"><br>
                    <button type="submit" name="update" class="btn btn-default">Update Staff Coordinator</button>
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
