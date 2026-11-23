<?php
// Q6: login page
session_start();
include "db.php";

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric   = $_POST['matric'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT matric, name, password, role FROM users WHERE matric = ?");
    mysqli_stmt_bind_param($stmt, "s", $matric);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['matric'] = $user['matric'];
        $_SESSION['name']   = $user['name'];
        $_SESSION['role']   = $user['role'];
        header("Location: users.php");
        exit();
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
    <?php if ($error) { ?>
        <!-- Figure 6 -->
        <p>Invalid username or password, try <a href="login.php">login</a> again.</p>
    <?php } else { ?>
        <!-- Figure 5 -->
        <form method="post" action="login.php">
            <label>Matric:</label>
            <input type="text" name="matric" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
        <br><br>
        <p><a href="register.php">Register</a> here if you have not.</p>
    <?php } ?>
    </div>
</body>
</html>
