<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'classes/db1.php';

// Initialize variables
$type_id = null;
$result = null;

// Check if 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the id parameter
    $type_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare a select statement
    $query = "SELECT * FROM events WHERE type_id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameter
        $stmt->bind_param("i", $type_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Close the statement
        $stmt->close();
    } else {
        echo "Error in prepared statement: " . $conn->error;
    }
} else {
    // 'id' parameter is not set, handle accordingly
    die('Type ID is missing.');
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest - Events</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest - Events</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .content {
            margin-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .event-title {
            color: #003300;
            font-size: 38px;
            margin-top: 0;
        }

        .event-details {
            margin-bottom: 20px;
        }

        .event-details p {
            margin-bottom: 5px;
        }

        .event-image {
            width: 70%;
            height: auto;
        }

        .btn-register {
            background-color: #0b0b45;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #0b0b45;
        }

        .btn-register:focus {
            background-color: #0b0b45;
            box-shadow: none;
        }

        .btn-register:active {
            background-color: #0b0b45;
        }

        .btn-register:disabled {
            background-color: #ccc;
            color: #333;
        }

        .btn-register:disabled:hover {
            background-color: #ccc;
        }

        @media (max-width: 768px) {
            .event-image {
                width: 100%;
            }

            .subcontent {
                padding-top: 20px;
            }
        }
    </style>
</head>
    
    
    <div class="content">
        <div class="container">
            <?php
            // Check if there are events found
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="row">
                        <section>
                            <div class="container">
                                <div class="col-md-6">
                                    <img src="<?php echo $row['image_link']; ?>" class="img-responsive" alt="Event Image" style="width: 70%; height: auto;">
                                </div>
                                <div class="subcontent col-md-6">
                                    <h1 style="color: #003300; font-size: 38px;"><strong><?php echo $row['event_title']; ?></strong></h1>
                                    <p><strong>Date:</strong> <?php echo $row['Date']; ?></p>
                                    <p><strong>Time:</strong> <?php echo $row['time']; ?></p>
                                    <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                                    <p><strong>Price:</strong> <?php echo $row['price']; ?></p>
                                    <p><strong>Staff Coordinator:</strong> <?php echo $row['staff_coordinator']; ?></p>
                                    <p><strong>Student Coordinator:</strong> <?php echo $row['student_coordinator']; ?></p>
                                    <a class="btn btn-default" href="registerEvent.php?id=<?php echo $row['event_id']; ?>"> <span class="glyphicon glyphicon-circle-arrow-right"></span> Register </a> <br> <br>
                                    <!-- <a href="registerEvent.php?event_id=" class="btn btn-primary">Register</a> -->
                                </div><!-- subcontent div -->
                            </div><!-- container div -->
                        </section>
                    </div><!-- row div -->
                    <?php
                }
            } else {
                echo "<div class='row'><div class='col-md-12'><p>No events found.</p></div></div>";
            }
            ?>
        </div><!-- container div -->
    </div><!-- content div -->

    
</body>
</html>
