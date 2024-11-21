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
    <div id="nurseContent" class="user-content">
        <h3>Nurse View</h3>
        <p class = "nurse-view">
        <h2 class = "roboto-bold">Patient List:</h2>
        <ul>
        <li onclick = "toggleInfo('info1')"> 
            Brown, Michael, ID: 089786756
                <div id = "info1" class = "patient-info">
                    <p class = "roboto-black-italic">Michael Brown</p>
                    <p>Date of Birth: 09/18/1988</p>
                    <p>Height: 6'2"</p>
                    <p>Weight: 200lbs</p>
                    <a href = "medical_records/michael_brown.pdf" target = "_blank">
                        <button class = "rounded-square-button"> View Medical Record</button>
                    </a>
                </div>
        </li>
        <li onclick = "toggleInfo('info2')"> 
            Davis, Emily, ID: 987654321
            <div id = "info2" class = "patient-info">
            <p class = "roboto-black-italic">Emily Davis</p>
            <p>Date of Birth: 03/10/2000</p>
            <p>Height: 5'4"</p>
            <p>Weight: 120lbs</p>
            <a href = "medical_records/emily_davis.pdf" target = "_blank">
                <button class = "rounded-square-button"> View Medical Record</button>
            </a>
            </div>
        </li>
        <li onclick = "toggleInfo('info3')"> 
            Doe, John, ID: 123456789
            <div id = "info3" class = "patient-info">
            <p class = "roboto-black-italic">John Doe</p>
            <p>Date of Birth: 01/15/1985</p>
            <p>Height: 5'9"</p>
            <p>Weight: 150lbs</p>
            <a href = "medical_records/john_doe.pdf" target = "_blank">
            <button class = "rounded-square-button"> View Medical Record</button>
            </a>
            </div>
        </li>
        <li onclick = "toggleInfo('info4')"> 
            Green, Samuel, ID: 567474632
            <div id = "info4" class = "patient-info">
                <p class = "roboto-black-italic" font-size: 20pt>Samuel Green</p>
                <p>Date of Birth: 10/30/1976</p>
                <p>Height: 5'11"</p>
                <p>Weight: 180lbs</p>
                <a href = "medical_records/samuel_green.pdf" target = "_blank">
                    <button class = "rounded-square-button" onclick = "window.location.href = web_src/medical_records/samuel_green " > View Medical Record</button>
                </a>
            </div>
        </li>
        <li onclick = "toggleInfo('info5')"> 
            Johnson, Mary, ID: 314253647
            <div id = "info5" class = "patient-info">
                <p class = "roboto-black-italic">Mary Johnson</p>
                <p>Date of Birth: 07/22/1992</p>
                <p>Height: 5'5"</p>
                <p>Weight: 135lbs</p>
                <a href = "medical_records/mary_johnson.pdf" target = "_blank">
                    <button class = "rounded-square-button"> View Medical Record</button>
                </a>
            </div>
        </li>
    </ul>
    </p>
</div>
</body>
</html>
