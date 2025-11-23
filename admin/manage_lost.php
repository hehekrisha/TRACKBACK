<?php
include '../config.php';

// Delete lost item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM lost_items WHERE id = $id");
}

// Mark as returned
if (isset($_GET['returned'])) {
    $id = $_GET['returned'];
    mysqli_query($conn, "UPDATE lost_items SET status='Returned' WHERE id = $id");
}

// Fetch data
$result = mysqli_query($conn, "SELECT * FROM lost_items ORDER BY date_lost DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Lost Items</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 95%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #333; color: white; }
        img { width: 80px; height: 80px; object-fit: cover; border-radius: 6px; }
        .btn { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; }
        .return { background: green; }
        .delete { background: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Lost Items</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Lost Location</th>
            <th>Date Lost</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>

            <td>
                <?php if ($row['photo'] != "") { ?>
                    <img src="../uploads/<?= $row['photo'] ?>">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>

            <td><?= $row['item_name'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['date_lost'] ?></td>

            <td><?= $row['status'] ?></td>

            <td>

                <?php if ($row['status'] != "Returned") { ?>
                    <a class="btn return" href="manage_lost.php?returned=<?= $row['id'] ?>"
                       onclick="return confirm('Mark this item as returned?')">
                       Mark Returned
                    </a>
                <?php } ?>

                <a class="btn delete" href="manage_lost.php?delete=<?= $row['id'] ?>"
                   onclick="return confirm('Delete this lost item record?')">
                   Delete
                </a>

            </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>