<?php
include '../config.php';

// Delete User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}

// Deactivate User
if (isset($_GET['deactivate'])) {
    $id = $_GET['deactivate'];
    mysqli_query($conn, "UPDATE users SET status='Inactive' WHERE id = $id");
}

// Activate User
if (isset($_GET['activate'])) {
    $id = $_GET['activate'];
    mysqli_query($conn, "UPDATE users SET status='Active' WHERE id = $id");
}

// Fetch Users
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 95%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #333; color: white; }
        .btn { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; }
        .activate { background: green; }
        .deactivate { background: orange; }
        .delete { background: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Users</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($user = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['full_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['status'] ?></td>

            <td>
                <?php if ($user['status'] == "Active") { ?>
                    <a class="btn deactivate" 
                       href="manage_user.php?deactivate=<?= $user['id'] ?>" 
                       onclick="return confirm('Deactivate this user?')">
                       Deactivate
                    </a>
                <?php } else { ?>
                    <a class="btn activate" 
                       href="manage_user.php?activate=<?= $user['id'] ?>" 
                       onclick="return confirm('Activate this user?')">
                       Activate
                    </a>
                <?php } ?>

                <a class="btn delete" 
                   href="manage_user.php?delete=<?= $user['id'] ?>" 
                   onclick="return confirm('Delete this user?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>