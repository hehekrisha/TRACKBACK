<?php
session_start();
include "../includes/db_connect.php";

$message = "";

// Handle login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT user_id, full_name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($uid, $fullname, $user_email, $hashed_pw);
        $stmt->fetch();

        if (password_verify($password, $hashed_pw)) {
            $_SESSION["user_id"] = $uid;
            $_SESSION["full_name"] = $fullname;

            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "No account found with this email.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Login – TRACKBACK</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #ffb7c5, #c7b8ff);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 380px;
        background: #ffffff;
        padding: 35px;
        border-radius: 22px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .login-card h2 {
        text-align: center;
        margin-bottom: 10px;
        font-weight: 700;
        color: #444;
    }

    .subtitle {
        text-align: center;
        font-size: 14px;
        margin-bottom: 25px;
        color: #666;
    }

    .login-card input {
        width: 100%;
        padding: 13px;
        margin: 10px 0;
        border: 1.5px solid #ddd;
        border-radius: 12px;
        font-size: 15px;
        transition: 0.3s ease;
    }

    .login-card input:focus {
        border-color: #c7b8ff;
        box-shadow: 0 0 4px #c7b8ff;
        outline: none;
    }

    button {
        width: 100%;
        padding: 14px;
        border: none;
        background: #c7b8ff;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    button:hover {
        background: #b19aff;
    }

    .msg {
        text-align: center;
        color: #d60000;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .bottom-links {
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
    }

    .bottom-links a {
        color: #7a5fff;
        text-decoration: none;
        font-weight: 600;
    }

    .bottom-links a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>

<div class="login-card">

    <h2>Welcome Back 👋</h2>
    <p class="subtitle">Log in to continue your search with TRACKBACK</p>

    <?php if ($message != ""): ?>
        <div class="msg"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>

        <input type="password" name="password"
               placeholder="Enter password" required>

        <button type="submit">Login</button>
    </form>

    <div class="bottom-links">
        <p>New user? <a href="register.php">Create an account</a></p>
        <p><a href="forgot_password.php">Forgot password?</a></p>
    </div>
</div>

</body>
</html>
