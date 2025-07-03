<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "intern_db");

$id = $_GET['id'];
$status = $_GET['status'];

$conn->query("UPDATE applications SET status='$status' WHERE id=$id");
header("Location: dashboard.php");
