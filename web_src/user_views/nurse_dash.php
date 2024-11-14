<?php
//include('../includes/auth.php');

//if (!isNurse()) {
   // header("Location: /views/login.php");
   //exit; 
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css">
    <title>Nurse Dashboard</title>
</head>
<body>
    <h1>Nurse Dashboard</h1>
    <p>Welcome, <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Guest'; ?>!</p>

    <h2>Today's Tasks</h2>
    <ul>
        <li>Administer medication to John Doe - 9:00 AM</li>
        <li>Check vitals for Mary Smith - 10:00 AM</li>
    </ul>

    <!-- Form to create a new physician order -->
    <h2>Create Physician Order</h2>
    <form action="../../data_src/api/mar_tar/create_order.php" method="POST">
        <label for="medication">Medication:</label>
        <input type="text" name="medication" required>

        <label for="dosage">Dosage:</label>
        <input type="text" name="dosage" required>

        <label for="frequency">Frequency:</label>
        <input type="text" name="frequency" required>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date">

        <label for="instructions">Instructions:</label>
        <textarea name="instructions"></textarea>

        <label for="physician_id">Physician ID:</label>
        <input type="number" name="physician_id" required>

        <label for="res_id">Resident ID:</label>
        <input type="text" id = "res_id" name="res_id" required>

        <label for="employee_id">Employee ID (Administered by):</label>
        <input type="number" name="employee_id" required>

        <button type="submit">Submit Order</button>
    </form>

    <!-- Display recent physician orders for testing -->
    <h2>Recent Physician Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Record ID</th>
            <th>Order Date</th>
            <th>Order Details</th>
            <th>Physician ID</th>
        </tr>
        <?php if (!empty($recentOrders)): ?>
            <?php foreach ($recentOrders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['rec_id'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_text']); ?></td>
                    <td><?php echo htmlspecialchars($order['physician_id']); ?></td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No recent orders found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="/public/index.php">Logout</a>
</body>
</html>
