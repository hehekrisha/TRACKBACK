<?php
// includes/functions.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clean input (XSS-safe)
function clean($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, "UTF-8");
}

// Redirect to another page
function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Check if user logged in
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        redirect("/user/login.php");
    }
}

// Flash messaging
function set_flash($msg, $type = "info") {
    $_SESSION['flash'] = [
        "message" => $msg,
        "type" => $type
    ];
}

function show_flash() {
    if (!empty($_SESSION['flash'])) {
        $type = $_SESSION['flash']['type'];
        $msg  = $_SESSION['flash']['message'];
        echo "<div class='flash $type'>$msg</div>";
        unset($_SESSION['flash']);
    }
}
?>
