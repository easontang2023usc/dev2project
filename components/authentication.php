<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        if (!headers_sent()) {
            header("Location: ../pages/login.php");
            exit();
        } else {
            echo '<script>window.location.href = "../pages/login.php";</script>';
            exit();
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function logout() {
    $_SESSION = array();
    session_destroy();
    header("Location: ../pages/login.php");
    exit();
}
?>