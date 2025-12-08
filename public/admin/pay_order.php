<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    die("Unauthorized access.");
}

if (!isset($_POST['order_id'])) {
    die("Invalid request.");
}

$order_id = $_POST['order_id'];

$db = new Dbh();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT total FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    die("Order not found.");
}

$amount = $order['total'];

$pay = $conn->prepare("
    INSERT INTO payments (order_id, amount, method)
    VALUES (?, ?, 'Cash')
");
$pay->bind_param("id", $order_id, $amount);
$pay->execute();

$update = $conn->prepare("UPDATE orders SET status = 'Paid' WHERE id = ?");
$update->bind_param("i", $order_id);
$update->execute();

header("Location: view_order.php?id=$order_id&paid=1");
exit();
?>