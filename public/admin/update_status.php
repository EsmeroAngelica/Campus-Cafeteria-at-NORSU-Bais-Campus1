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

$stmt = $conn->prepare("UPDATE orders SET status='Completed' WHERE id = ?");
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    header("Location: view_order.php?id=$order_id&updated=1");
} else {
    echo "Failed to update status.";
}
exit();
?>