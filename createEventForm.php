<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            color: #000000;
        }

        .form-control {
            margin-bottom: 15px;
        }

        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Event</h2>
    <form action="saveEvent.php" method="post" onsubmit="return validateDate()">
        <div class="form-group">
            <label for="type_id">Type ID:</label>
            <input type="text" class="form-control" id="type_id" name="type_id" required>
        </div>
        <div class="form-group">
            <label for="title">Event Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
            <small id="dateError" class="form-text text-danger"></small> <!-- Error message placeholder -->
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" class="form-control" id="time" name="time" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="image_link">Image Link:</label>
            <input type="text" class="form-control" id="image_link" name="image_link" required>
        </div>
        <div class="form-group">
            <label for="staff_coordinator">Staff Coordinator:</label>
            <input type="text" class="form-control" id="staff_coordinator" name="staff_coordinator" required>
        </div>
        <div class="form-group">
            <label for="student_coordinator">Student Coordinator:</label>
            <input type="text" class="form-control" id="student_coordinator" name="student_coordinator" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>

<script>
    // Function to validate the date input
    function validateDate() {
        var inputDate = document.getElementById("date").value;
        var today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

        if (inputDate < today) {
            document.getElementById("dateError").innerHTML = "Date must be today or a future date.";
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

</body>
</html>
