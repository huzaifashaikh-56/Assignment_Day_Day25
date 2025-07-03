<?php
$conn = new mysqli("localhost", "root", "", "intern_db");
$hash = password_hash("admin123", PASSWORD_DEFAULT); // change password if needed
$conn->query("INSERT INTO admin (email, password) VALUES ('admin@example.com', '$hash')");
echo "Admin added.";
?>
