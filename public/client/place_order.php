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

// 1. Get cart items
$cart_result = $conn->query("
    SELECT cart.*, menu_items.price, menu_items.stock 
    FROM cart 
    JOIN menu_items ON cart.item_id = menu_items.id
    WHERE cart.user_id = $user_id
");

if ($cart_result->num_rows == 0) {
    die("Cart is empty.");
}

// 2. Check stock availability
while ($item = $cart_result->fetch_assoc()) {
    if ($item['quantity'] > $item['stock']) {
        die("Not enough stock for item ID: " . $item['item_id']);
    }
}

// Reset pointer
$cart_result->data_seek(0);

// 3. Compute total price
$total = 0;
while ($item = $cart_result->fetch_assoc()) {
    $total += $item['price'] * $item['quantity'];
}

// 4. Insert into orders
$conn->query("
    INSERT INTO orders (user_id, total, status)
    VALUES ($user_id, $total, 'Pending')
");

$order_id = $conn->insert_id;

// Reset pointer again
$cart_result->data_seek(0);

// 5. Insert order items + deduct stock + insert logs
while ($item = $cart_result->fetch_assoc()) {

    $menu_id = $item['item_id'];
    $qty = $item['quantity'];
    $price = $item['price'];

    // Insert into order_items
    $conn->query("
        INSERT INTO order_items (order_id, menu_id, quantity, price)
        VALUES ($order_id, $menu_id, $qty, $price)
    ");

    // Deduct stock
    $conn->query("
        UPDATE menu_items 
        SET stock = stock - $qty
        WHERE id = $menu_id
    ");

    // Insert inventory log
    $conn->query("
        INSERT INTO inventory_logs (menu_id, change_amount, reason)
        VALUES ($menu_id, -$qty, 'Order Deduction')
    ");
}

// 6. Clear the cart
$conn->query("DELETE FROM cart WHERE user_id = $user_id");

// 7. Redirect user
header("Location: order_success.php?order_id=" . $order_id);
exit();
?>