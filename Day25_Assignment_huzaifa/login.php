<?php
session_start();
$conn = new mysqli("localhost", "root", "", "intern_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    
    $result = $conn->query("SELECT * FROM admin WHERE email='$email'");
    $row = $result->fetch_assoc();
    
    if ($row && password_verify($pass, $row['password'])) {
        $_SESSION['admin'] = $email;
        header("Location: dashboard.php");
    } else {
        echo "Wrong email or password.";
    }
}
?>

<form method="POST">
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <input type="submit" value="Login">
</form>
