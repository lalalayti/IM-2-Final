<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "library-management-system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name  = $conn->real_escape_string($_POST['first_name']);
    $middle_name = $conn->real_escape_string($_POST['middle_name']);
    $last_name   = $conn->real_escape_string($_POST['last_name']);
    $email       = $conn->real_escape_string($_POST['email']);
    $password    = $_POST['password'];

    $sql = "INSERT INTO users (first_name, middle_name, last_name, email, password)
            VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Signup successful!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/signup-styles.css" />
</head>
<body>
    <div class="signup-container">
        <h2>Create an Account</h2>
        <!-- Show result message if set -->
        <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="first_name" placeholder="John" required>
            </div>
            <div class="form-group">
                <label for="middlename">Middle Name</label>
                <input type="text" id="middlename" name="middle_name" placeholder="Michael">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="last_name" placeholder="Doe" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>
            <button class="submit-btn" type="submit">Sign Up</button>
        </form>
        <div class="footer-text">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>
</body>
</html>
