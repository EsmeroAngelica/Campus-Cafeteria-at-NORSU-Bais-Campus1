<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

$user_id = $_SESSION['user_id'];

// get cart items
$query = "
    SELECT cart.quantity, menu_items.*
    FROM cart 
    JOIN menu_items ON cart.item_id = menu_items.id
    WHERE cart.user_id = $user_id
";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-6xl font-bold mb-4">Checkout</h1>

<p class="text-lg mb-6 text-black">Confirm your order below:</p>

<table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg mb-6">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3">Item</th>
            <th class="p-3">Qty</th>
            <th class="p-3">Price</th>
            <th class="p-3">Total</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $grand_total = 0;

        while ($row = $result->fetch_assoc()):
            $total = $row['price'] * $row['quantity'];
            $grand_total += $total;
        ?>
        <tr class="border-b">
            <td class="p-4"><?= $row['name']; ?></td>
            <td class="p-4"><?= $row['quantity']; ?></td>
            <td class="p-4">₱<?= $row['price']; ?></td>
            <td class="p-4 font-semibold">₱<?= $total; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2 class="text-3xl font-bold mb-6">Grand Total: ₱<?= $grand_total; ?></h2>

<form action="place_order.php" method="POST">
    <button class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
        Place Order
    </button>
</form>
<br>
<a href="cart.php"
   class="inline-block px-6 py-3 bg-gray-700 text-white rounded-lg font-semibold 
          hover:bg-gray-800 shadow-lg hover:shadow-gray-500/50 transition duration-300 ml-4">
    ← Back to Cart
</a>

</body>
</html>