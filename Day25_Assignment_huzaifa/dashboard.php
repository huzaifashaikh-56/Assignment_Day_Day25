<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "intern_db");
$result = $conn->query("SELECT * FROM applications");

echo "<h2>Applications</h2>";
echo "<table border='1'><tr><th>Name</th><th>Email</th><th>Resume</th><th>Status</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['name']}</td>
      <td>{$row['email']}</td>
      <td><a href='{$row['resume']}' target='_blank'>View</a></td>
      <td>{$row['status']}</td>
      <td>
        <a href='update.php?id={$row['id']}&status=Selected'>Select</a> | 
        <a href='update.php?id={$row['id']}&status=Rejected'>Reject</a>
      </td>
    </tr>";
}
echo "</table>";
?>

<a href="logout.php">Logout</a>
