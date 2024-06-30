<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Unset admin session if already set
if (isset($_SESSION["admin_loggedin"])) {
    unset($_SESSION["admin_loggedin"]);
}

// Debug: Check form submission
if (isset($_POST["login"])) {
    echo "Form submitted!"; // Check if form is submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // For demonstration, checking against plain text
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION["admin_loggedin"] = true;
        header("location: adminPage.php");
        exit;
    } else {
        $login_error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        .error-msg {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <h2 class="text-center">Admin Login</h2>
                <form method="POST" action="admin_login.php"> <!-- Ensure correct action -->
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
                    <?php if(isset($login_error)) { ?>
                        <div class="error-msg"><?php echo $login_error; ?></div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
