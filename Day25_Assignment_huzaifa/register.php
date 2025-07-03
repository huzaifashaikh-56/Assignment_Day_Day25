<?php
$conn = new mysqli("localhost", "root", "", "intern_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $file = $_FILES["resume"];
    
    $allowed = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    
    if (in_array($file['type'], $allowed) && $file['size'] <= 2*1024*1024) {
        $filename = uniqid() . "_" . basename($file["name"]);
        $target = "uploads/" . $filename;
        move_uploaded_file($file["tmp_name"], $target);

        $stmt = $conn->prepare("INSERT INTO applications (name, email, resume) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $target);
        $stmt->execute();
        echo "Application submitted!";
    } else {
        echo "Invalid file. Only PDF/DOC/DOCX under 2MB allowed.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
  Name: <input type="text" name="name" required><br>
  Email: <input type="email" name="email" required><br>
  Resume: <input type="file" name="resume" required><br>
  <input type="submit" value="Submit Application">
</form>

