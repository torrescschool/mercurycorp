<?php
session_start();
include('../../data_src/includes/db_config.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data for dropdowns and recent records
    $recentOrders = $pdo->query("SELECT order_id, rec_id, order_date, order_text, physician_id FROM physician_orders ORDER BY order_date DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    $physicians = $pdo->query("SELECT physician_id, last_name, first_name FROM physician")->fetchAll(PDO::FETCH_ASSOC);
    $residents = $pdo->query("SELECT res_id, last_name, first_name FROM residents")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nurse Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/mercurycorp/mercurycorp/web_src/style.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container d-flex align-items-center">
            <img src="../photos/mercuryCorpLogo.png" alt="MercuryCorp Logo" class="me-3" style="height: 50px;">
            <h1 class="h3">Mercury Corp - Nurse Dashboard</h1>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container">
            <a class="navbar-brand" href="#">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Nurse'); ?></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="../logout.php" class="nav-link text-white">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        <!-- Tasks Section -->
        <section>
            <h2>Today's Tasks</h2>
            <ul class="list-group">
                <?php if (!empty($todaysTasks)): ?>
                    <?php foreach ($todaysTasks as $task): ?>
                        <li class="list-group-item">
                            <?php echo htmlspecialchars($task['task_description']); ?> - 
                            <span class="text-muted"><?php echo htmlspecialchars($task['task_time']); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item">No tasks for today.</li>
                <?php endif; ?>
            </ul>
        </section>

        <!-- Medication Administration Records -->
        <section class="mt-5">
            <h2>Medication Administration Records</h2>
            <form action="nurse_dash.php" method="GET" class="mb-3">
                <div class="input-group">
                    <label class="input-group-text" for="res_id">Filter by Resident</label>
                    <select name="res_id" id="res_id" class="form-select">
                        <option value="">Select a resident</option>
                        <?php foreach ($residents as $resident): ?>
                            <option value="<?php echo htmlspecialchars($resident['res_id']); ?>">
                                <?php echo htmlspecialchars($resident['last_name'] . ', ' . $resident['first_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </section>

        <!-- Recent Physician Orders -->
        <section class="mt-5">
            <h2>Recent Physician Orders</h2>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Resident ID</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Physician ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['rec_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_text']); ?></td>
                            <td><?php echo htmlspecialchars($order['physician_id']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
