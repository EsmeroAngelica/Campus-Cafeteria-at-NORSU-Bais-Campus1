<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$cart_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$db = new Dbh();
$conn = $db->connect();

// Delete only the cart row belonging to this user
$query = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
$conn->query($query);

header("Location: cart.php");
exit();
?>