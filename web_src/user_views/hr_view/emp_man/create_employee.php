<form method="POST">
    <input type="text" name="name" placeholder="Employee Name" required>
    <input type="text" name="role" placeholder="Role" required>
    <input type="number" name="salary" placeholder="Salary" required>
    <button type="submit">Add Employee</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    
    $query = "INSERT INTO employees (name, role, salary) VALUES ('$name', '$role', '$salary')";
    mysqli_query($conn, $query);
    header('Location: employee_management.php');
}
?>