<?php
include '../config.php';

// Delete single log
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM logs WHERE id = $id");
}

// Delete all logs
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "TRUNCATE TABLE logs");
}

// Fetch logs
$result = mysqli_query($conn, "SELECT * FROM logs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logs</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 90%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { margin: 0 0 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background: #333; color: #fff; }
        .btn-delete { color: red; text-decoration: none; }
        .btn-clear { padding: 10px 15px; background: red; color: white; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>User Activity Logs</h2>

    <a class="btn-clear" href="logs.php?delete_all=1" onclick="return confirm('Delete ALL logs?')">
        Delete All Logs
    </a>

    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Action</th>
            <th>IP Address</th>
            <th>Date & Time</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['user'] ?></td>
            <td><?= $row['action'] ?></td>
            <td><?= $row['ip'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a class="btn-delete" href="logs.php?delete=<?= $row['id'] ?>" 
                   onclick="return confirm('Delete this log?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>