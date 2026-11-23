<?php
// Database connection (XAMPP default: user root, no password)
$conn = mysqli_connect("localhost", "root", "", "Lab_5b");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
