<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM employees WHERE id='$id'";
    mysqli_query($conn, $query);
    header('Location: employee_management.php');
}
?>