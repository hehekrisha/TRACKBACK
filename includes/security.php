<?php
// includes/security.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| CLEAN STRING (XSS PROTECTION)
|--------------------------------------------------------------------------
*/
function clean($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/*
|--------------------------------------------------------------------------
| GENERATE CSRF TOKEN
|--------------------------------------------------------------------------
*/
function generate_csrf()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/*
|--------------------------------------------------------------------------
| VALIDATE CSRF TOKEN
|--------------------------------------------------------------------------
*/
function verify_csrf($token)
{
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

/*
|--------------------------------------------------------------------------
| ESCAPE OUTPUT (SAFE PRINTING)
|--------------------------------------------------------------------------
*/
function e($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
