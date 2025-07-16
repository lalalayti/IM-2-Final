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
        <h2>Log in</h2>
        <form>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" placeholder="example@mail.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="********" required>
        </div>
        <button class="submit-btn" type="submit"><a href="index.php">Log in</a></button>
        </form>
        <div class="footer-text">
        Dont have an account? <a href="signup.php">Sign up</a>
        </div>
        </div>
</body>
</html>