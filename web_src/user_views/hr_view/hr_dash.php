<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../../data_src/api/user/login.php");
    exit;
}

// Check if user has the correct role for this page
if ($_SESSION['role'] !== 'HR') {
    echo "Access denied.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/styles.css">
    <title>HR Dashboard</title>
</head>
<body>
    <h1>Human Resourse Dashboard</h1>
    <p>Welcome, <?php echo $_GET['user']; ?>!</p>

    <h2>HR Information</h2>
    <ul>
        <li>Blah blah</li>
        <li>Blah blah</li>
    </ul>

    <a href="/public/index.php">Logout</a>
</body>
</html>