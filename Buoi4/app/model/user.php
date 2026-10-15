<?php
require_once __DIR__ . '/../common/dbConnect.php';

function getUserByUsername(string $username): array|false
{
    global $conn;
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function registerUser(string $username, string $password): bool
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    return $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
}
