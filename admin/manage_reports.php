<?php
include '../config.php';

// Delete report
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM reports WHERE id = $id");
}

// Mark Report as Reviewed
if (isset($_GET['review'])) {
    $id = $_GET['review'];
    mysqli_query($conn, "UPDATE reports SET status='Reviewed' WHERE id = $id");
}

// Fetch all reports
$result = mysqli_query($conn, "SELECT * FROM reports ORDER BY date_reported DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reports</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 95%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #333; color: white; }
        .btn { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; }
        .review { background: blue; }
        .delete { background: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage User Reports</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Report Type</th>
            <th>User Name</th>
            <th>Message</th>
            <th>Date Reported</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['report_type'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['message'] ?></td>
            <td><?= $row['date_reported'] ?></td>
            <td><?= $row['status'] ?></td>

            <td>
                <?php if ($row['status'] != "Reviewed") { ?>
                    <a class="btn review" 
                       href="manage_report.php?review=<?= $row['id'] ?>"
                       onclick="return confirm('Mark this report as reviewed?')">
                       Mark Reviewed
                    </a>
                <?php } ?>

                <a class="btn delete" 
                   href="manage_report.php?delete=<?= $row['id'] ?>"
                   onclick="return confirm('Delete this report?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>