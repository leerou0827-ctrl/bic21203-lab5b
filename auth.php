<?php
// Q9: include this at the top of every protected page
session_start();

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}
?>
