<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

$query = "
    SELECT 
        payments.id AS payment_id,
        payments.amount,
        payments.created_at,
        orders.id AS order_id,
        users.name AS customer_name
    FROM payments
    JOIN orders ON payments.order_id = orders.id
    JOIN users ON users.id = orders.user_id
    ORDER BY payments.created_at DESC
";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-6xl font-bold mb-6">💳 Payments</h1>
<br>

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="p-3 text-left">Payment ID</th>
                <th class="p-3 text-left">Order ID</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Amount</th>
                <th class="p-3 text-left">Date</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="border-b">
                    <td class="p-3"><?= $row['payment_id']; ?></td>
                    <td class="p-3"><?= $row['order_id']; ?></td>
                    <td class="p-3"><?= htmlspecialchars($row['customer_name']); ?></td>
                    <td class="p-3">₱<?= number_format($row['amount'], 2); ?></td>
                    <td class="p-3"><?= $row['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td class="p-4 text-center text-gray-500" colspan="5">
                        No payments recorded yet.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<br></br>

<a href="home.php"
   class="inline-block mb-6 px-6 py-3 rounded-full 
          bg-blue-600 hover:bg-blue-700 
          text-white font-semibold shadow-lg 
          hover:shadow-blue-500/50 transition duration-300">
    ← Back to Admin Home
</a>

</body>
</html>