<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid item.");
}

$item_id = $_GET['id'];

$db = new Dbh();
$conn = $db->connect();

$stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $item_id);

if ($stmt->execute()) {
    header("Location: manage_menu.php?deleted=1");
} else {
    echo "Failed to delete item.";
}
exit();
?>