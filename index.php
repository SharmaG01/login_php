<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for local server
$password = ""; // Default password for local server
$dbname = "if0_37911031_loginpage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sign Up Logic
if (isset($_POST['signUp'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password for security

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $user, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $user, $email, $pass);
        $stmt->execute();
        echo "<script>alert('Signup Successful!');</script>"; // Popup message after successful signup
    }
}

// Login Logic
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if the username exists
    $loginQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($loginQuery);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // Redirect to user.html after successful login
            echo "<script>window.location.href = 'user.html';</script>";
        } else {
            echo "Incorrect Password!";
        }
    } else {
        echo "No user found with this username!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="wrapper">
    <div class="form-wrapper sign-in">
      <form action="" method="POST">
        <h2>Login</h2>
        <div class="input-group">
          <input type="text" name="username" required>
          <label for="">Username</label>
        </div>
        <div class="input-group">
          <input type="password" name="password" required>
          <label for="">Password</label>
        </div>
        <div class="remember">
          <label><input type="checkbox"> Remember me</label>
        </div>
        <button type="submit" name="login">Login</button>
        <div class="signUp-link">
          <p>Don't have an account? <a href="#" class="signUpBtn-link">Sign Up</a></p>
        </div>
      </form>
    </div>
    <div class="form-wrapper sign-up">
      <form action="" method="POST">
        <h2>Sign Up</h2>
        <div class="input-group">
          <input type="text" name="username" required>
          <label for="">Username</label>
        </div>
        <div class="input-group">
          <input type="email" name="email" required>
          <label for="">Email</label>
        </div>
        <div class="input-group">
          <input type="password" name="password" required>
          <label for="">Password</label>
        </div>
        <div class="remember">
          <label><input type="checkbox" name="terms" required> I agree to the terms & conditions</label>
        </div>
        <button type="submit" name="signUp">Sign Up</button>
        <div class="signUp-link">
          <p>Already have an account? <a href="#" class="signInBtn-link">Sign In</a></p>
        </div>
      </form>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
