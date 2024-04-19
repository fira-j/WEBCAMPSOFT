<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user is registered
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User is registered, validate the password
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Successful login, redirect to the home page or desired location
            header('Location: /home');
            exit();
        } else {
            // Invalid password, display an error message
            $errorMessage = "Invalid email or password.";
        }
    } else {
        // User is not registered, display a signup message
        $signupMessage = "You are not registered. Please sign up first.";
    }
}

// Check if the forgot password form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forgot_email'])) {
    $forgotEmail = $_POST['forgot_email'];

    // Check if the user is registered
    $sql = "SELECT * FROM users WHERE email = '$forgotEmail'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User is registered, send password reset instructions to the user's email
        // You can implement your own logic for sending the reset instructions
        
        // Display a success message to the user
        $resetMessage = "Password reset instructions sent to your email.";
    } else {
        // User is not registered, display an error message
        $forgotErrorMessage = "Invalid email.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } elseif (isset($signupMessage)) { ?>
        <p><?php echo $signupMessage; ?></p>
    <?php } ?>
    <form action="/login" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
    
    <br>
    
    <h3>Forgot Password?</h3>
    <?php if (isset($forgotErrorMessage)) { ?>
        <p><?php echo $forgotErrorMessage; ?></p>
    <?php } elseif (isset($resetMessage)) { ?>
        <p><?php echo $resetMessage; ?></p>
    <?php } ?>
    <form action="/forgot-password" method="post">
        <label for="forgot_email">Email:</label>
        <input type="email" id="forgot_email" name="forgot_email" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>