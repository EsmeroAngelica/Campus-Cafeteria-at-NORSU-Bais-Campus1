<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

if (!isset($_GET['id'])) {
    die("Invalid item.");
}

$item_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $update = $conn->prepare("
        UPDATE menu_items 
        SET name=?, description=?, price=?, category=? 
        WHERE id=?
    ");
    $update->bind_param("ssdsi", $name, $desc, $price, $category, $item_id);

    if ($update->execute()) {
        header("Location: manage_menu.php?updated=1");
        exit();
    } else {
        echo "Update failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Item</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h2 class="text-3xl font-bold mb-6">Edit Menu Item</h2>

<form method="POST" class="bg-white p-6 rounded-xl shadow-lg max-w-lg">

    <label class="font-semibold">Name</label>
    <input type="text" name="name" value="<?= $item['name']; ?>" class="input input-bordered w-full mb-4">

    <label class="font-semibold">Description</label>
    <textarea name="description" class="textarea textarea-bordered w-full mb-4"><?= $item['description']; ?></textarea>

    <label class="font-semibold">Price</label>
    <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" class="input input-bordered w-full mb-4">

    <label class="font-semibold">Category</label>
    <select name="category" class="select select-bordered w-full mb-4">
        <option <?= $item['category']=="Meals"?"selected":"" ?>>Meals</option>
        <option <?= $item['category']=="Snacks"?"selected":"" ?>>Snacks</option>
        <option <?= $item['category']=="Drinks"?"selected":"" ?>>Drinks</option>
    </select>

    <button class="btn btn-primary w-full mt-3">Update Item</button>

<br></br>
    <a href="manage_menu.php"
   class="inline-block mb-6 px-6 py-3 rounded-full 
          bg-blue-600 hover:bg-blue-700 
          text-white font-semibold shadow-lg 
          hover:shadow-blue-500/50 transition duration-300">
    ← Back to Manage Menu
</a>
</form>

</body>
</html>