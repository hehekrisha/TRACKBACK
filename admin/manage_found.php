<?php
include '../config.php';

// Delete a found item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM found_items WHERE id = $id");
}

// Mark item as "Claimed"
if (isset($_GET['claim'])) {
    $id = $_GET['claim'];
    mysqli_query($conn, "UPDATE found_items SET status='Claimed' WHERE id = $id");
}

// Fetch all found items
$result = mysqli_query($conn, "SELECT * FROM found_items ORDER BY date_found DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Found Items</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 95%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #333; color: white; }
        img { width: 80px; height: 80px; object-fit: cover; border-radius: 6px; }
        .btn { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; }
        .approve { background: green; }
        .delete { background: red; }
        .claimed { background: orange; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Found Items</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Found Location</th>
            <th>Date Found</th>
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
            <td><?= $row['date_found'] ?></td>

            <td><?= $row['status'] ?></td>

            <td>

                <?php if ($row['status'] != "Claimed") { ?>
                    <a class="btn approve" href="manage_found.php?claim=<?= $row['id'] ?>"
                       onclick="return confirm('Mark this item as claimed?')">
                        Mark Claimed
                    </a>
                <?php } ?>

                <a class="btn delete" href="manage_found.php?delete=<?= $row['id'] ?>"
                   onclick="return confirm('Delete this item?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>