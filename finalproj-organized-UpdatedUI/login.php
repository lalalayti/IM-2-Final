<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "library-management-system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if user exists with matching email and password
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        // Login successful
        session_start();
        $_SESSION['email'] = $email;
        header("Location: index.php"); // Redirect to homepage
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid email or password');</script>";
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/signup-styles.css" />
</head>
<body>
    <div class="signup-container">
        <h2>Log in</h2>
        <!-- Form submits to same page -->
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>
            <button class="submit-btn" type="submit">Log in</button>
        </form>
        <div class="footer-text">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </div>
</body>
</html>
