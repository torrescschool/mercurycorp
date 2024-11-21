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
?>

<!-- Employee Management Page -->
<h3>Employee Management</h3>

<!-- Search / Filter form -->
<form method="GET" action="">
    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="">All</option>
        <option value="nurse">Nurse</option>
        <option value="physician">Physician</option>
        <!-- Add other roles  -->
    </select>
    <button type="submit">Filter</button>
</form> <br><br>

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
                    <a href="delete_employee.php?emp_id=<?php echo $employee['emp_id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table><br><br>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by name or ID">
    <button type="submit">Search</button>
</form>

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
