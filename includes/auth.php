<?php
// includes/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../includes/db_connect.php";
require_once __DIR__ . "/../includes/functions.php";

/*
|--------------------------------------------------------------------------
| LOGIN USER
|--------------------------------------------------------------------------
| Validates login, checks password, creates session
*/
function login_user($email, $password)
{
    global $conn;

    $email = clean($email);

    $query = $conn->prepare("SELECT user_id, full_name, email, password, role FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            // Set login session
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['role']      = $user['role'];

            return true;
        }
    }

    return false;
}

/*
|--------------------------------------------------------------------------
| LOGOUT USER
|--------------------------------------------------------------------------
*/
function logout_user()
{
    session_unset();
    session_destroy();
    header("Location: /user/login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| CHECK IF LOGGED IN
|--------------------------------------------------------------------------
*/
function require_user_login()
{
    if (!isset($_SESSION['user_id'])) {
        set_flash("You must be logged in to access this page.", "error");
        redirect("/user/login.php");
    }
}

/*
|--------------------------------------------------------------------------
| CHECK ADMIN ROLE
|--------------------------------------------------------------------------
*/
function require_admin()
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
        set_flash("Access denied.", "error");
        redirect("/index.php");
    }
}
