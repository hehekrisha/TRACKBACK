<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && $password == $user['password']) {
        $_SESSION['admin'] = $user['name'];
        header("Location: admin_dashboard.php");
    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>
</html>