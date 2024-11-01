<?php
//include('../includes/auth.php');

//if (!isNurse()) {
   // header("Location: /views/login.php");
   //exit; 
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=".../styles.css">
    <title>Nurse Dashboard</title>
</head>
<body>
    <h1>Nurse Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['user']; ?>!</p>

    <h2>Today's Tasks</h2>
    <ul>
        <li>Administer medication to John Doe - 9:00 AM</li>
        <li>Check vitals for Mary Smith - 10:00 AM</li>
    </ul>

    <a href="/public/index.php">Logout</a>
</body>
</html>
