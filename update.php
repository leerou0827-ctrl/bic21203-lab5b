<?php
// Q7: update user (Figure 8)
include "auth.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldMatric = $_POST['old_matric'];
    $matric    = trim($_POST['matric']);
    $name      = trim($_POST['name']);
    $role      = trim($_POST['role']);

    $stmt = mysqli_prepare($conn, "UPDATE users SET matric = ?, name = ?, role = ? WHERE matric = ?");
    mysqli_stmt_bind_param($stmt, "ssss", $matric, $name, $role, $oldMatric);
    mysqli_stmt_execute($stmt);

    // keep session in sync if user edited their own record
    if ($oldMatric == $_SESSION['matric']) {
        $_SESSION['matric'] = $matric;
        $_SESSION['name']   = $name;
        $_SESSION['role']   = $role;
    }

    header("Location: users.php");
    exit();
}

$matric = $_GET['matric'] ?? "";
$stmt = mysqli_prepare($conn, "SELECT matric, name, role FROM users WHERE matric = ?");
mysqli_stmt_bind_param($stmt, "s", $matric);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$user) {
    die("User not found. <a href='users.php'>Back</a>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h1>Update User</h1>
        <form method="post" action="update.php">
            <input type="hidden" name="old_matric" value="<?php echo htmlspecialchars($user['matric']); ?>">

            <label>Matric</label>
            <input type="text" name="matric" maxlength="10" required
                   value="<?php echo htmlspecialchars($user['matric']); ?>"><br>

            <label>Name</label>
            <input type="text" name="name" maxlength="100" required
                   value="<?php echo htmlspecialchars($user['name']); ?>"><br>

            <label>Access Level</label>
            <input type="text" name="role" maxlength="10" required
                   value="<?php echo htmlspecialchars($user['role']); ?>"><br>

            <input type="submit" value="Update">
            <a href="users.php">Cancel</a>
        </form>
    </div>
</body>
</html>
