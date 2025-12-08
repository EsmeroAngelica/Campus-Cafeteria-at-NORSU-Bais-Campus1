<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid order ID.");
}

$order_id = $_GET['id'];

$db = new Dbh();
$conn = $db->connect();

$order_stmt = $conn->prepare("
    SELECT orders.*, users.name AS customer_name 
    FROM orders 
    JOIN users ON users.id = orders.user_id
    WHERE orders.id = ?
");
$order_stmt->bind_param("i", $order_id);
$order_stmt->execute();
$order = $order_stmt->get_result()->fetch_assoc();

$items_stmt = $conn->prepare("
    SELECT order_items.*, menu_items.name, menu_items.price 
    FROM order_items
    JOIN menu_items ON menu_items.id = order_items.menu_id
    WHERE order_items.order_id = ?
");
$items_stmt->bind_param("i", $order_id);
$items_stmt->execute();
$items = $items_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<?php if (isset($_GET['paid']) && $_GET['paid'] == 1): ?>
    <div class="p-4 bg-green-100 text-green-800 border border-green-400 rounded mb-4">
        ✅ Payment successful! Order is now marked as <strong>Paid</strong>.
    </div>
<?php endif; ?>

<h1 class="text-4xl font-bold mb-6">Order #<?= $order_id ?> Details</h1>

<p class="text-lg mb-4">
    <strong>Customer:</strong> <?= $order['customer_name']; ?><br>

    <strong>Status:</strong>
    <?php if ($order['status'] == "Pending"): ?>
        <span class="px-3 py-1 bg-yellow-400 text-black rounded-full">Pending</span>
    <?php elseif ($order['status'] == "Paid"): ?>
        <span class="px-3 py-1 bg-green-600 text-white rounded-full">Paid</span>
    <?php else: ?>
        <span class="px-3 py-1 bg-gray-500 text-white rounded-full"><?= $order['status']; ?></span>
    <?php endif; ?>
    <br>

    <strong>Total:</strong> ₱<?= number_format($order['total'], 2); ?><br>
    <strong>Placed At:</strong> <?= $order['created_at']; ?>
</p>

<table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3">Item</th>
            <th class="p-3">Qty</th>
            <th class="p-3">Price</th>
            <th class="p-3">Subtotal</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($item = $items->fetch_assoc()): ?>
        <tr class="border-b">
            <td class="p-3"><?= $item['name']; ?></td>
            <td class="p-3"><?= $item['quantity']; ?></td>
            <td class="p-3">₱<?= number_format($item['price'], 2); ?></td>
            <td class="p-3">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php if ($order['status'] == 'Pending'): ?>
    <form action="pay_order.php" method="POST" class="inline-block mt-4">
        <input type="hidden" name="order_id" value="<?= $order_id; ?>">
        <button type="submit"
            class="inline-block px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700">
            Mark as Paid
        </button>
    </form>
<?php else: ?>
    <p class="mt-4 text-green-700 font-semibold">
        ✔ This order is already Paid.
    </p>
<?php endif; ?>

<a href="orders.php"
   class="inline-block mt-6 px-6 py-3 bg-gray-600 text-white rounded hover:bg-gray-700">
   ← Back to Orders
</a>

<a href="delete_order.php?id=<?= $order_id; ?>"
   class="inline-block mt-4 px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700"
   onclick="return confirm('Are you sure you want to delete this order?');">
   🗑 Delete Order
</a>

</body>
</html>