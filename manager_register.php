<?php
session_start();
include('includes/db.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $error = "Username already exists!";
    } else {
        $insert = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'manager')";
        if ($conn->query($insert) === TRUE) {
            $success = "Account created! You can now log in.";
        } else {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Sign Up</title>
    <link rel="stylesheet" href="assets/css/manager_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Manager Sign Up</h2>
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success-msg'>$success</p>"; ?>
        <form method="POST">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <input type="submit" name="register" value="Register">
        </form>

        <p style="text-align: center;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
