<?php
include('db_queries.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/mercurycorp/mercurycorp/web_src/style.css">
    <title>Nurse Dashboard</title>
</head>
<bod>
    <!-- Header Section -->
    <header class="row">
        <div class="col-1">
          <img class="main_logo" src="photos/mercuryCorpLogo.png" alt="MercuryCorp logo">
        </div>
        <div class="col">
          <h1 class = "abril-fatface-regular">Mercury</h1>
        </div>
      </header>      
      <nav class="navbar" style="background-color: rgb(133, 161,170); height: 70px">
        <!-- Navbar content -->
        <a id = "nav-bar options" href = "login.html" class = "arima-subtitle">Log out</a>
      </nav>

    <!-- Welcome Message -->
    <div class="container mt-4">
        <h2 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Nurse'); ?>!</h2>

        <!-- Today's Tasks Section -->
        <section class="my-4">
            <h3>Today's Tasks</h3>
            <ul class="list-group">
                <?php if (!empty($todaysTasks)): ?>
                    <?php foreach ($todaysTasks as $task): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($task['task_description']) ?> at <?= htmlspecialchars($task['task_time']) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">No tasks for today.</li>
                <?php endif; ?>
            </ul>
        </section>

        <!-- Medication Records Filter -->
        <section class="my-4">
            <h3>Medication Administration Records</h3>
            <form action="nurse_dash.php" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="res_id" class="form-label">Filter by Resident</label>
                    <select name="res_id" id="res_id" class="form-select" required>
                        <option value="">Select a resident</option>
                        <?php foreach ($residents as $resident): ?>
                            <option value="<?= htmlspecialchars($resident['res_id']) ?>">
                                <?= htmlspecialchars($resident['last_name'] . ', ' . $resident['first_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </section>

        <!-- Recent Orders Section -->
        <section class="my-4">
            <h3>Recent Physician Orders</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Resident ID</th>
                        <th>Order Date</th>
                        <th>Details</th>
                        <th>Physician</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['rec_id']) ?></td>
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            <td><?= htmlspecialchars($order['order_text']) ?></td>
                            <td><?= htmlspecialchars($order['physician_id']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <h2>Patient List</h2>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
