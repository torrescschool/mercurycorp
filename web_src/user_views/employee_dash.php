<?php
//include('../includes/auth.php');

//if (!isResident()) {
    //header("Location: /views/login.php");
   // exit;
//}

//shows HR and resident information that the resident is okay sharing. Employees can also be nurses

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Employee Dashboard</title>
</head>
<body>
    <h1>Employee Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['user']; ?>!</p>

    <h2>HR Information</h2>
    <ul>
        <li>Blah blah</li>
        <li>Blah blah</li>
    </ul>

    <a href="/public/index.php">Logout</a>
</body>
</html>
<?PHP
include "../footer.php";
?>
