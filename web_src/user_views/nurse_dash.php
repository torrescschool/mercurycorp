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
<body>
    <!-- Header Section -->
    <header class="d-flex align-items-center p-3 bg-light">
        <img src="../photos/mercuryCorpLogo.png" alt="MercuryCorp logo" class="me-3" style="width: 50px;">
        <h1>Mercury Corp - Nurse Dashboard</h1>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
