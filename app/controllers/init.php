<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ?action=login");
        exit;
    }
}

function requireAdmin($redirect = true) {
        if (!isLoggedIn() || !isAdmin()) {
        if ($redirect) {
            header("Location: ?action=vehiculos");
            exit;
        }
        return false;
    }
    return true;
}
?>