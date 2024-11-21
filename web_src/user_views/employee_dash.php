<?php
// Include database configuration
include('../../data_src/includes/db_config.php');  
session_start(); 

$conn = new mysqli($host, $dbUsername, $dbPassword, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
// if (!isset($_SESSION['emp_id'])) {
//     header('Location: login.php'); // Redirect to login if not logged in
//     exit;
// }

// Fetch employee details
$username = $_SESSION['username'];

$sqlUser = "SELECT first_name FROM employees WHERE email = ?";
$stmtUser = $conn->prepare($sqlUser);

if ($stmtUser) {
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser && $resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        $firstName = $rowUser['first_name'];
    }
    $stmtUser->close();
}

$sql = "SELECT e.emp_id, e.first_name, e.last_name, e.job_title, e.department_id, e.email, e.mobile_no, 
               d.dept_name, e.salary 
        FROM employees e 
        JOIN departments d ON e.department_id = d.dept_id 
        WHERE e.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$employee = $result->fetch_assoc();
if (!$employee) {
    echo "Employee not found.";
    exit;
}
?>

<!-- Employee Dashboard -->
<h3>Welcome, <?php echo htmlspecialchars($employee['first_name'] . " " . $employee['last_name']); ?>!</h3>
<p>Role: <?php echo htmlspecialchars($employee['job_title']); ?></p>

<!-- Basic Information -->
<h4>Your Information</h4>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Full Name</th>
        <td><?php echo htmlspecialchars($employee['first_name'] . " " . $employee['last_name']); ?></td>
    </tr>
    <tr>
        <th>Job Title</th>
        <td><?php echo htmlspecialchars($employee['job_title']); ?></td>
    </tr>
    <tr>
        <th>Department</th>
        <td><?php echo htmlspecialchars($employee['dept_name']); ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo htmlspecialchars($employee['email']); ?></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><?php echo htmlspecialchars($employee['mobile_no']); ?></td>
    </tr>
    <!-- <tr>
        <th>Date Hired</th>
        <td><?php echo htmlspecialchars($employee['date_hired']); ?></td>
    </tr> -->
    <tr>
        <th>Salary</th>
        <td><?php echo htmlspecialchars($employee['salary']); ?></td>
    </tr>
</table>

<!-- Links for Employee Actions -->
<h4>Actions</h4>
<ul>
    <li><a href="update_profile.php">Update Personal Details</a></li>
    <li><a href="leave_requests.php">View Leave Balance/Requests</a></li>
    <li><a href="documents.php">Access Personal Files</a></li>
</ul>