<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

$item_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$qty = isset($_GET['qty']) ? intval($_GET['qty']) : 1; 

if (!$item_id || $qty < 1) {
    die("Invalid item or quantity.");
}

$check = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND item_id = $item_id");

if ($check->num_rows > 0) {
    $conn->query("UPDATE cart SET quantity = quantity + $qty 
                  WHERE user_id = $user_id AND item_id = $item_id");
} else {
    $conn->query("INSERT INTO cart (user_id, item_id, quantity) 
                  VALUES ($user_id, $item_id, $qty)");
}

header("Location: cart.php");
exit;
?>