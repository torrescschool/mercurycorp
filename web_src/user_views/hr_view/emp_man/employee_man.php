<?php
include('../../../../data_src/includes/db_config.php');  
$conn = new mysqli($host, $dbUsername, $dbPassword, $database);


// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all employees (nurses and other roles)
$sql = "SELECT e.emp_id, e.first_name, e.last_name, e.job_title, e.department_id, e.email, e.salary, d.dept_name, e.dob 
        FROM employees e JOIN departments d ON e.department_id = d.dept_id";
$result = $conn->query($sql);

// Check if there are employees
$employees = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

$totalEmployees = $conn->query("SELECT COUNT(*) AS total FROM employees")->fetch_assoc()['total'];
$averageSalary = $conn->query("SELECT AVG(salary) AS average FROM employees")->fetch_assoc()['average'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- CSS Source-->
  <link href="../../../style.css" rel="stylesheet">
  <!-- Google Font API-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Arima:wght@100..700&display=swap" rel="stylesheet">
  <!-- JavaScript Source-->
  <!-- <script src="main.js"></script> -->
    <title>Employee Management</title>
    <script src="https://kit.fontawesome.com/d896ee4cb8.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="row">
        <div class="col-1">
          <img class="main_logo" src="../../../photos/mercuryCorpLogo.png" alt="MercuryCorp logo">
        </div>
        <div class="col">
          <h1 class = "abril-fatface-regular">Mercury Corp</h1>
        </div>
      </header>  
      <nav class="navbar navbar-expand-lg" style="background-color: rgb(133, 161, 170); height: 70px;">
        <div class="container-fluid">
    
            
            <div class="collapse navbar-collapse" id="navbarNav">
            <h3>Employee Management</h3>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../../index.html" class="btn btn-light ms-2">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../../logout.php">Logout</a></li>
                </ul>
            </div>

            
        </div>
    </nav>


<!-- Search / Filter form -->
<!-- <form method="GET" action="">
    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="">All</option>
        <option value="nurse">Nurse</option>
        <option value="physician">Physician</option> -->
        <!-- Add other roles  -->
    <!-- </select>
    <button type="submit">Filter</button>
</form> <br><br> -->

<!-- Statistics Section -->
<h4>Overview</h4>
<ul>
    <li>Total Employees: <?php echo $totalEmployees; ?></li>
    <li>Average Salary: <?php echo number_format($averageSalary, 2); ?> USD</li>
</ul>

<!-- Add New Employee Button -->
<a href="create_employee.php">Add New Employee</a>

<br><br>
<!-- Employee Table -->
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Job Title</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): 
          
            // Calculate Age
            $dob = new DateTime($employee['dob']);
            $today = new DateTime();
            $age = $employee['dob'] ? $today->diff($dob)->y : "N/A";
        ?> 
            <tr>
                <td><?php echo htmlspecialchars($employee['first_name']) . " " . htmlspecialchars($employee['last_name']); ?></td>
                <td><?php echo htmlspecialchars($employee['job_title']); ?></td>
                <td><?php echo htmlspecialchars($employee['dept_name']); ?></td>
                <td><?php echo htmlspecialchars($employee['salary']); ?></td>
                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                <td><?php echo htmlspecialchars($employee['dob']); ?></td>
                <td><?php echo htmlspecialchars($age); ?></td>
                <td>
                    <a href="update_employee.php?emp_id=<?php echo $employee['emp_id']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table><br><br>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by name or ID">
    <button type="submit">Search</button>
</form>

<footer>
  <p> 2024 Mercury Corp. All rights reserved.</p>
  <p>Follow us on social media!</p>
  <img class = "socialMediaIcon" src = "../../../photos/facebook.png" alt = "Facebook">
  <img class = "socialMediaIcon" src = "../../../photos/instagram.png" alt = "Instagram">
  <img class = "socialMediaIcon" src = "../../../photos/twitter.png" alt = "Twitter">
</footer>
</body>
</html>


<?php
// Handle Search
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query = "SELECT * FROM employees WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
    $search_result = $conn->query($query);

    if ($search_result && $search_result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<ul>";
        while ($row = $search_result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No employees found.</p>";
    }
}
 ?>
