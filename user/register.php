<?php
session_start();
include "../includes/db_connect.php";

$message = "";

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Validation
    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Email already registered!";
        } else {
            // Hash password
            $hashed_pw = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user
            $stmt = $conn->prepare(
                "INSERT INTO users (full_name, email, password, phone) 
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $fullname, $email, $hashed_pw, $phone);

            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit;
            } else {
                $message = "Something went wrong. Try again.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account – TRACKBACK</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #ffb7c5, #c7b8ff);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        width: 420px;
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

    h2 {
        text-align: center;
        margin-bottom: 5px;
        font-weight: 700;
        color: #444;
    }

    .subtitle {
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
        color: #666;
    }

    input {
        width: 100%;
        padding: 13px;
        margin: 10px 0;
        border: 1.5px solid #ddd;
        border-radius: 12px;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus {
        border-color: #c7b8ff;
        box-shadow: 0 0 4px #c7b8ff;
        outline: none;
    }

    button {
        width: 100%;
        padding: 14px;
        background: #c7b8ff;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 5px;
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
        margin-top: 10px;
        text-align: center;
        font-size: 14px;
    }

    .bottom-links a {
        color: #7a5fff;
        font-weight: 600;
        text-decoration: none;
    }

    .bottom-links a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>

<div class="register-card">

    <h2>Create Account ✨</h2>
    <p class="subtitle">Join TRACKBACK and never lose track again!</p>

    <?php if ($message != ""): ?>
        <div class="msg"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="fullname" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="text" name="phone" placeholder="Phone Number (optional)">

        <input type="password" name="password" placeholder="Create Password" required>

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit">Create Account</button>
    </form>

    <div class="bottom-links">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

</div>

</body>
</html>
