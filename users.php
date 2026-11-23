<?php
// Q5 + Q7: display users with Update and Delete links
include "auth.php";
include "db.php";

$result = mysqli_query($conn, "SELECT matric, name, role AS accessLevel FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top">
        Logged in as <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
        | <a href="logout.php">Logout</a>
    </div>

    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['matric']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['accessLevel']); ?></td>
            <td><a href="update.php?matric=<?php echo urlencode($row['matric']); ?>">Update</a></td>
            <td><a href="delete.php?matric=<?php echo urlencode($row['matric']); ?>"
                   onclick="return confirm('Delete this user?');">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
