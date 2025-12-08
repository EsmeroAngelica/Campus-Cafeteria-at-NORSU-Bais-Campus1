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

$query = "
    SELECT cart.id AS cart_id, cart.quantity, menu_items.*
    FROM cart 
    JOIN menu_items ON cart.item_id = menu_items.id
    WHERE cart.user_id = $user_id
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-4xl font-bold mb-6">🛒 Your Cart</h1>

<a href="menu.php"
   class="inline-block px-6 py-3 mb-6 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition duration-300">
   ← Continue Ordering
</a>

<?php if ($result->num_rows == 0): ?>
    <p class="text-gray-600 text-xl">Your cart is empty.</p>

    <a href="menu.php" class="mt-6 px-5 py-2 bg-blue-600 text-white rounded-lg inline-block">
        Browse Menu
    </a>

<?php else: ?>

<table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-2">Item</th>
            <th class="p-2">Price</th>
            <th class="p-2">Qty</th>
            <th class="p-5">Total</th>
            <th class="p-2">Action</th>
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
            <td class="p-5 font-semibold"><?= $row['name']; ?></td>
            <td class="p-5">₱<?= $row['price']; ?></td>
            <td class="p-5"><?= $row['quantity']; ?></td>
            <td class="p-5 font-bold">₱<?= $total; ?></td>

            <td class="p-2">
                <a href="remove_from_cart.php?id=<?= $row['cart_id']; ?>"
                   class="text-red-600 font-bold">Remove</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2 class="text-4xl font-bold mt-10">Grand Total: ₱<?= $grand_total; ?></h2>

<a href="checkout.php" class="mt-6 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg inline-block">
    Proceed to Checkout
</a>

<?php endif; ?>

</body>
</html>