<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

// FILTER SYSTEM
$status_filter = "";

if (isset($_GET['status'])) {
    $stat = $_GET['status'];
    $status_filter = "WHERE orders.status = '$stat'";
}

$query = "
    SELECT orders.*, users.name AS customer 
    FROM orders 
    JOIN users ON users.id = orders.user_id
    $status_filter
    ORDER BY orders.id DESC
";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Orders</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-5xl font-bold mb-10">📦 Customer Orders</h1>

<!-- FILTER BUTTONS -->
<div class="mb-4 space-x-2">
    <a href="orders.php" class="px-4 py-2 bg-gray-600 text-white rounded">All</a>
    <a href="orders.php?status=Pending" class="px-4 py-2 bg-yellow-500 text-white rounded">Pending</a>
    <a href="orders.php?status=Paid" class="px-4 py-2 bg-green-600 text-white rounded">Paid</a>
</div>

<table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3">Order ID</th>
            <th class="p-3">Customer</th>
            <th class="p-3">Total</th>
            <th class="p-3">Status</th>
            <th class="p-3">Date</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="border-b">
            <td class="p-3"><?= $row['id'] ?></td>
            <td class="p-3"><?= $row['customer'] ?></td>
            <td class="p-3">₱<?= number_format($row['total'], 2) ?></td>

            <!-- STATUS BADGE FIXED -->
            <td class="p-3">
                <?php if ($row['status'] == "Pending"): ?>
                    <span class="px-3 py-1 bg-yellow-400 text-black rounded-full">Pending</span>

                <?php elseif ($row['status'] == "Paid"): ?>
                    <span class="px-3 py-1 bg-green-500 text-white rounded-full">Paid</span>

                <?php else: ?>
                    <span class="px-3 py-1 bg-gray-500 text-white rounded-full"><?= $row['status'] ?></span>
                <?php endif; ?>
            </td>

            <td class="p-3"><?= $row['created_at'] ?></td>

            <td class="p-4">
                <a href="view_order.php?id=<?= $row['id']; ?>" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                View
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<br>
<a href="home.php"
   class="inline-block mb-6 px-6 py-3 rounded-full 
          bg-blue-600 hover:bg-blue-700 
          text-white font-semibold shadow-lg 
          hover:shadow-blue-500/50 transition duration-300">
    ← Back to Admin Home
</a>
</body>
</html>