<?php
include('../includes/config.php');  // Include the database connection
include('../includes/auth.php');    // Ensure the user is logged in

// Check if the user is authorized to access this page (HR, IT in the future)
if (!isHR()) {
    header("Location: /views/login.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id']
    $role = $_POST['role'];


    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role, id) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $hashedPassword, $role, $id]);
        $success = "User successfully created!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>
    
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="nurse">Nurse</option>
            <option value="resident">Resident</option>
            <option value="hr">Human Resources</option>
            <option value="employee">Employee</option>
        </select>

        <label for="id">Enter Resident/Employee Identifying Number</label>
        <input type="id" id = "id" name ="id" required>
        <!--make sure the id is in the database first-->
        
        <button type="submit">Create User</button>

        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>

    <a href="/public/index.php">Back to Dashboard</a>
</body>
</html>
