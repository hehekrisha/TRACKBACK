<?php
// Include database connection
include 'config.php';

// Add Announcement
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];

    $query = "INSERT INTO announcements (title, message, created_at) VALUES ('$title', '$message', NOW())";
    mysqli_query($conn, $query);
}

// Delete Announcement
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM announcements WHERE id = $id");
}

// Fetch all announcements
$result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; padding: 20px; }
        .container { width: 60%; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #aaa; padding: 10px; }
        th { background: #333; color: white; }
        .btn-delete { color: red; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Announcement</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Announcement Title" required>
        <textarea name="message" placeholder="Announcement Message" required></textarea>
        <button type="submit" name="add">Add Announcement</button>
    </form>

    <h2>All Announcements</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['message'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a class="btn-delete" href="announcement.php?delete=<?= $row['id'] ?>">Delete</a></td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>