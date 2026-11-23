<?php
// Q3: registration page (no session check, per Q9)
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric   = trim($_POST['matric']);
    $name     = trim($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    if ($matric == "" || $name == "" || $_POST['password'] == "" || $role == "") {
        $message = "<p class='error'>Please fill in all fields.</p>";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $matric, $name, $password, $role);

        try {
            mysqli_stmt_execute($stmt);
            $message = "<p>Registration successful. <a href='login.php'>Login</a> now.</p>";
        } catch (mysqli_sql_exception $e) {
            $message = "<p class='error'>Error: matric number already registered.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <form method="post" action="register.php">
            <label>Matric:</label>
            <input type="text" name="matric" maxlength="10" required><br>

            <label>Name:</label>
            <input type="text" name="name" maxlength="100" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <label>Role:</label>
            <select name="role" required>
                <option value="">Please select</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select><br>

            <input type="submit" value="Submit">
        </form>
        <?php echo $message; ?>
        <p><a href="login.php">Login</a> if you already have an account.</p>
    </div>
</body>
</html>
