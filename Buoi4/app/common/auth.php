<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id'], $_SESSION['username']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function redirectIfLoggedIn(): void
{
    if (isLoggedIn()) {
        header('Location: product_list.php');
        exit;
    }
}
