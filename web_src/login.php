<?php
include('../includes/config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'nurse') {
            header("Location: /views/nurse-dashboard.php");
        } elseif ($user['role'] === 'resident') {
            header("Location: /views/resident-dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>