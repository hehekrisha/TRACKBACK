<?php
include '../config.php';

// Fetch current settings
$settings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM system_settings WHERE id = 1"));

// Update settings on form submission
if (isset($_POST['update_settings'])) {
    $site_name = $_POST['site_name'];
    $contact_email = $_POST['contact_email'];

    mysqli_query($conn, "UPDATE system_settings SET 
        site_name='$site_name', 
        contact_email='$contact_email'
        WHERE id=1");
}

// Update admin login details
if (isset($_POST['update_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $password = md5($password); // encrypt password
        mysqli_query($conn, "UPDATE admin SET username='$username', password='$password' WHERE id=1");
    } else {
        mysqli_query($conn, "UPDATE admin SET username='$username' WHERE id=1");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { width: 50%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h2 { margin-bottom: 15px; }
        label { font-weight: bold; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 15px; background: #333; color: white; border: none; border-radius: 6px; }
    </style>
</head>
<body>

<div class="container">

    <h2>System Settings</h2>

    <form method="POST">
        <label>Website / System Name</label>
        <input type="text" name="site_name" value="<?= $settings['site_name'] ?>" required>

        <label>Contact Email</label>
        <input type="email" name="contact_email" value="<?= $settings['contact_email'] ?>" required>

        <button name="update_settings">Update Settings</button>
    </form>


    <h2 style="margin-top:30px;">Admin Login Settings</h2>

    <?php 
    $admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE id = 1"));
    ?>

    <form method="POST">
        <label>Admin Username</label>
        <input type="text" name="username" value="<?= $admin['username'] ?>" required>

        <label>New Password (Leave blank to keep same)</label>
        <input type="password" name="password" placeholder="Enter new password">

        <button name="update_admin">Update Admin</button>
    </form>

</div>

</body>
</html>