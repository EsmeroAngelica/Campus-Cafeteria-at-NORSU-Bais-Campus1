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

$cart_result = $conn->query("
    SELECT cart.*, menu_items.price, menu_items.stock 
    FROM cart 
    JOIN menu_items ON cart.item_id = menu_items.id
    WHERE cart.user_id = $user_id
");

if ($cart_result->num_rows == 0) {
    die("Cart is empty.");
}

while ($item = $cart_result->fetch_assoc()) {
    if ($item['quantity'] > $item['stock']) {
        die("Not enough stock for item ID: " . $item['item_id']);
    }
}

$cart_result->data_seek(0);

$total = 0;
while ($item = $cart_result->fetch_assoc()) {
    $total += $item['price'] * $item['quantity'];
}

$conn->query("
    INSERT INTO orders (user_id, total, status)
    VALUES ($user_id, $total, 'Pending')
");

$order_id = $conn->insert_id;

$cart_result->data_seek(0);

while ($item = $cart_result->fetch_assoc()) {

    $menu_id = $item['item_id'];
    $qty = $item['quantity'];
    $price = $item['price'];

    $conn->query("
        INSERT INTO order_items (order_id, menu_id, quantity, price)
        VALUES ($order_id, $menu_id, $qty, $price)
    ");

    $conn->query("
        UPDATE menu_items 
        SET stock = stock - $qty
        WHERE id = $menu_id
    ");

    $conn->query("
        INSERT INTO inventory_logs (menu_id, change_amount, reason)
        VALUES ($menu_id, -$qty, 'Order Deduction')
    ");
}

$conn->query("DELETE FROM cart WHERE user_id = $user_id");

header("Location: order_success.php?order_id=" . $order_id);
exit();
?>