<?php
session_start();

// Admin login check
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "campus_lostfound";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

// Count items for dashboard
$lost = $conn->query("SELECT COUNT(*) AS total FROM lost_items")->fetch_assoc()['total'];
$found = $conn->query("SELECT COUNT(*) AS total FROM found_items")->fetch_assoc()['total'];
$reports = $conn->query("SELECT COUNT(*) AS total FROM reports")->fetch_assoc()['total'];
$users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f4f4f4; 
            margin: 0; 
            padding: 0;
        }
        .header {
            background: #333; 
            padding: 15px; 
            color: white; 
            text-align: center;
        }
        .sidebar {
            width: 200px; 
            background: #222;
            height: 100vh; 
            position: fixed; 
            top: 0; 
            left: 0; 
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            display: block; 
            padding: 12px; 
            color: white; 
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #444;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .box {
            width: 200px; 
            padding: 20px; 
            background: white; 
            display: inline-block; 
            margin: 10px;
            text-align: center; 
            box-shadow: 0px 0px 8px gray;
            font-size: 20px;
            border-radius: 10px;
        }
        .logout-btn {
            background: red; 
            padding: 10px; 
            color: white; 
            border: none;
            margin-top: 20px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 style="text-align:center;">ADMIN</h2>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="manage_lost.php">Manage Lost</a>
    <a href="manage_found.php">Manage Found</a>
    <a href="manage_report.php">Reports</a>
    <a href="announcement.php">Announcements</a>
    <a href="manage_user.php">Users</a>
    <a href="logs.php">Logs</a>
    <a href="settings.php">Settings</a>

    <form method="POST">
        <button name="logout" class="logout-btn">Logout</button>
    </form>
</div>

<div class="content">
    <h1>Welcome, <?php echo $_SESSION['admin']; ?></h1>

    <div class="box">Lost Items<br><b><?php echo $lost; ?></b></div>
    <div class="box">Found Items<br><b><?php echo $found; ?></b></div>
    <div class="box">Reports<br><b><?php echo $reports; ?></b></div>
    <div class="box">Users<br><b><?php echo $users; ?></b></div>
</div>

<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
}
?>

</body>
</html>