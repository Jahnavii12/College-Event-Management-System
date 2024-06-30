<?php
include_once 'classes/db1.php';

// Start session
session_start();

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // User Authentication Logic
    $sql = "SELECT id, username, password FROM users WHERE username = ?"; // Changed to search by username
    echo "SQL: $sql"; // Debugging statement to print the SQL query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $name, $hashed_password);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["name"] = $name;

                        // Redirect user to index.php
                        header("location: events.php");
                        exit; // Ensure no further code execution after redirection
                    } else {
                        // Display an error message if password is not valid
                        echo "<script>alert('Invalid Password'); window.location.href='login_form.php';</script>";
                        exit; // Ensure no further code execution after displaying error
                    }
                }
            } else {
                // Display an error message if username is not found
                echo "<script>alert('User not found'); window.location.href='login_form.php';</script>";
                exit; // Ensure no further code execution after displaying error
            }
        } else {
            echo "Oops! Something went wrong. Please try again later."; // Display error if execution fails
        }
        $stmt->close();
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error; // Print any errors during query preparation
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #0b0b45;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button[type="submit"]:hover {
            background-color: #000;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <h2 class="text-center">User Login</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
