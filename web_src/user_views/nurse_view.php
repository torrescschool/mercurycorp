
<?php
session_start();

if ($_SESSION['role'] == 'nurse') {
    header("Location: /nurse-dashboard.php");
} elseif ($_SESSION['role'] == 'resident') {
    header("Location: /resident-dashboard.php");
} else {
    header("Location: /login.php");
}
?>

<h1>Welcome, Nurse (name) </h1>
<div class="tasks">
    <h2>Your Tasks for Today</h2>
    <ul>
        <li>Administer medication to John Doe - 9:00 AM</li>
        <li>Check vital signs for Mary Smith - 10:00 AM</li>
        <li>Update patient notes by 12:00 PM</li>
    </ul>
</div>
<form method="POST" action="submit-task.php">
    <input type="text" name="task" placeholder="New Task">
    <button type="submit">Add Task</button>
</form>
