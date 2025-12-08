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

// Delete its items first
$conn->query("DELETE FROM order_items WHERE order_id = $order_id");

// Delete the order
if ($conn->query("DELETE FROM orders WHERE id = $order_id")) {
    header("Location: orders.php?deleted=1");
} else {
    echo "Failed to delete order";
}
exit();
?>