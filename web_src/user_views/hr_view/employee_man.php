<?php
// Assuming you have a database connection setup already
include('../../../data_src/includes/db_config.php');  
$conn = new mysqli($host, $dbUsername, $dbPassword, $database);

// Fetch all employees (nurses, physicians, and other roles)
$sql = "SELECT e.emp_id, e.first_name, e.last_name, e.job_title, e.department_id, e.email, d.dept_name 
        FROM employees e JOIN departments d ON e.department_id = d.dept_id";
$result = $conn->query($sql);

// Check if there are employees
$employees = [];
if ($result->num_rows > 0) {
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
        <!-- Add the other roles if you want to  -->
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Add New Employee Button -->
<a href="add_employee.php">Add New Employee</a>

<!-- Employee Table -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Job Title</th>
            <th>Department</th>
            <th>Email</th>
            <th>Assigned Patients</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?php echo htmlspecialchars($employee['first_name']) . " " . htmlspecialchars($employee['last_name']); ?></td>
                <td><?php echo htmlspecialchars($employee['job_title']); ?></td>
                <td><?php echo htmlspecialchars($employee['dept_name']); ?></td>
                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                <td>
                    <!-- Fetch assigned patients for physicians/nurses -->
                    <?php
                    if ($employee['dept_name'] === 'Physician' || $employee['dept_name'] === 'Nursing') {
                        $patientSql = "SELECT first_name FROM residents  WHERE physician_id = ?";
                        $stmt = $conn->prepare($patientSql);
                        $stmt->bind_param("i", $employee['emp_id']);
                        $stmt->execute();
                        $patientResult = $stmt->get_result();
                        
                        $patients = [];
                        while ($patient = $patientResult->fetch_assoc()) {
                            $patients[] = $patient['first_name'];
                        }
                        
                        echo implode(", ", $patients);
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
                <td>
                    <a href="edit_employee.php?emp_id=<?php echo $employee['emp_id']; ?>">Edit</a>
                    <a href="delete_employee.php?emp_id=<?php echo $employee['emp_id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

