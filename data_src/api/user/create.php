<?php
include('../../includes/db_config.php');  // Include the database connection
// include('../includes/auth.php');    // Ensure the user is logged in
// Create database connection 
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $database);

// Check if the user is authorized to access this page (HR, IT in the future)
// if (!isHR()) {
//     header("Location: /views/login.php");
//     exit;
// }

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $role = $_POST['role'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if (!isset($username, $password,$id, $role)) {
        exit('Please complete the registration form!');
    }

    // Check if the username already exists
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Username already exists
        $error = "Username already exists. Please choose a different username.";
    } else {
        // Prepare the INSERT statement
        $stmt = $mysqli->prepare("INSERT INTO Users (username, password, role, id) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $hashedPassword, $role, $id); // Bind parameters
            
            // Execute the statement and check for success
            if ($stmt->execute()) {
                $success = "User successfully created!";
                header("Location: ../../../web_src/login.html");
            } else {
                $error = "Error: " . $stmt->error; // Use statement error
            }
            $stmt->close();
        } else {
            $error = "Error preparing the statement: " . $mysqli->error;
        }
    }

}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- CSS Source-->
  <link href="../../../web_src/style.css" rel="stylesheet">
  <!-- Google Font API-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Arima:wght@100..700&display=swap" rel="stylesheet">
  <!-- JavaScript Source-->
  <script src="main.js"></script>
  <title>Mercury Corp - Software Engineering Final Project.</title>
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/d896ee4cb8.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="row">
        <div class="col-1">
          <img class="main_logo" src="../../../web_src/photos/mercuryCorpLogo.png" alt="MercuryCorp logo">
        </div>
        <div class="col">
          <h1 class = "abril-fatface-regular">Mercury Corp</h1>
        </div>
      </header>      
      <nav class="navbar" style="background-color: rgb(133, 161,170); height: 70px">
        <!-- Navbar content -->
        <a id = "nav-bar options" href = "index.html" class = "arima-subtitle">Home</a>
        <!-- <a id = "nav-bar options" href = "Residents.html" class = "arima-subtitle">Residents</a>
        <a id = "nav-bar options" href = "login.html" class = "arima-subtitle">Login</a> -->
      </nav>
      <h2 class = "arima-subtitle" font-stle:"italic"> Create your user account</h2>
      <div id="intro" class="section-text col d-flex justify-content-center align-items-center" style="height: 900px;">
    <div class="white-box text-center" style="background-color: white; padding: 70px; width: 500px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="container mt-5">
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="username" class="form-label"><strong>Username:</strong></label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label"><strong>Password:</strong></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="role" class="form-label"><strong>Role:</strong></label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="" disabled selected>Select a role</option>
                        <option value="resident">Resident</option>
                        <option value="hr">Physician</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="id" class="form-label"><strong>Enter Resident/Employee Identifying Number:</strong></label>
                    <input type="text" id="id" name="id" class="form-control" required>
                </div>
        
                <button type="submit" class="btn btn-primary w-100">Create User</button>

                <?php if (isset($success)) echo "<p class='text-success mt-3'>$success</p>"; ?>
                <?php if (isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
            </form>
        </div>
    </div>
</div>
        

    <a href="/public/index.php">Back to Dashboard</a>
</body>
<footer>
  <p> 2024 Mercury Corp. All rights reserved.</p>
  <p>Follow us on social media!</p>
  <img class = "socialMediaIcon" src = "../../../web_src/photos/facebook.png" alt = "Facebook">
  <img class = "socialMediaIcon" src = "../../../web_src/photos/instagram.png" alt = "Instagram">
  <img class = "socialMediaIcon" src = "../../../web_src/photos/twitter.png" alt = "Twitter">
</footer>
</html>
