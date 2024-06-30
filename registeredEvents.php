<?php
include_once 'classes/db1.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login_form.php");
    exit;
}

// Get user ID from the session
$user_id = $_SESSION["id"];

// Initialize variables for form validation errors
$card_number_err = $exp_date_err = $cvv_err = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_payment"])) {
    // Validate Card Number
    if (empty(trim($_POST["card_number"]))) {
        $card_number_err = "Please enter card number.";
    } else {
        $card_number = trim($_POST["card_number"]);
        if (!is_numeric($card_number) || strlen($card_number) !== 16) {
            $card_number_err = "Card number must be 16 digits.";
        }
    }

    // Validate Expiration Date
    if (empty(trim($_POST["exp_date"]))) {
        $exp_date_err = "Please enter expiration date.";
    } else {
        $exp_date = trim($_POST["exp_date"]);
        // Here you can add more specific validation for expiration date format
    }

    // Validate CVV
    if (empty(trim($_POST["cvv"]))) {
        $cvv_err = "Please enter CVV.";
    } else {
        $cvv = trim($_POST["cvv"]);
        if (!is_numeric($cvv) || strlen($cvv) !== 3) {
            $cvv_err = "CVV must be 3 digits.";
        }
    }

    // If all fields are valid, proceed with payment processing
    if (empty($card_number_err) && empty($exp_date_err) && empty($cvv_err)) {
        // Here you can process the payment, but for now we'll just show a confirmation
        $amount = $_POST['amount'];
        echo "<script>alert('Payment of $$amount successfully processed.');</script>";

        // Insert payment details into payments table
        $sql_insert_payment = "INSERT INTO payments (user_id, card_number, exp_date, cvv, amount) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_payment = $conn->prepare($sql_insert_payment);

        if ($stmt_insert_payment) {
            $stmt_insert_payment->bind_param("isssd", $user_id, $card_number, $exp_date, $cvv, $amount);
            $stmt_insert_payment->execute();
            $stmt_insert_payment->close();

            // Redirect to events.php after successful payment
            header("location: events.php");
            exit;
        } else {
            echo "Error inserting payment details: " . $conn->error;
        }
    }
}

// Prepare and execute SQL to get events registered by the user
$sql = "SELECT e.event_id, e.event_title, e.price FROM events e
        INNER JOIN event_registrations er ON e.event_id = er.event_id
        WHERE er.user_id = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare was successful
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total amount
$total_amount = 0;
while ($row = $result->fetch_assoc()) {
    $total_amount += $row['price'];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registered Events</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>Make Payment</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="card_number">Card Number:</label>
                        <input type="text" id="card_number" name="card_number" class="form-control <?php echo (!empty($card_number_err)) ? 'is-invalid' : ''; ?>" required>
                        <span class="invalid-feedback"><?php echo $card_number_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="exp_date">Expiration Date:</label>
                        <input type="text" id="exp_date" name="exp_date" class="form-control <?php echo (!empty($exp_date_err)) ? 'is-invalid' : ''; ?>" required>
                        <span class="invalid-feedback"><?php echo $exp_date_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" class="form-control <?php echo (!empty($cvv_err)) ? 'is-invalid' : ''; ?>" required>
                        <span class="invalid-feedback"><?php echo $cvv_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Total Amount ($):</label>
                        <!-- Display total amount -->
                        <input type="text" id="amount" name="amount" class="form-control" value="<?php echo htmlspecialchars($total_amount); ?>" readonly>
                    </div>
                    <button type="submit" name="submit_payment" class="btn btn-primary">Submit Payment</button>
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
