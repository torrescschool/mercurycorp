<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../data_src/api/user/login.php");
    exit;
}

// Check if user has the correct role for this page
if ($_SESSION['role'] !== 'Physician') {
    echo "Access denied.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=".../styles.css">
    <title>Physician Dashboard</title>
</head>
<body>
    <h1>Physician Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['user']; ?>!</p>

    <h2>Today's Tasks</h2>
    <ul>
        <li>Administer medication to John Doe - 9:00 AM</li>
        <li>Check vitals for Mary Smith - 10:00 AM</li>
    </ul>

    <a href="/public/index.php">Logout</a>
</body>
</html>