<?php
// Q7: delete user
include "auth.php";
include "db.php";

$matric = $_GET['matric'] ?? "";

$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE matric = ?");
mysqli_stmt_bind_param($stmt, "s", $matric);
mysqli_stmt_execute($stmt);

// if user deleted their own account, log them out
if ($matric == $_SESSION['matric']) {
    header("Location: logout.php");
} else {
    header("Location: users.php");
}
exit();
?>
