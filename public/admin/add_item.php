<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../public/admin/login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $upload_path = "../public/images/" . $image;

    move_uploaded_file($tmp_name, $upload_path);

    $db = new Dbh();
    $conn = $db->connect();

    $stmt = $conn->prepare("
        INSERT INTO menu_items (name, category, price, description, image)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssdss", $name, $category, $price, $description, $image);

    if ($stmt->execute()) {
        header("Location: manage_menu.php?added=success");
        exit();
    } else {
        $message = "❌ Failed to add item!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Menu Item</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-4xl font-bold mb-6">➕ Add New Menu Item</h1>

<?php if ($message): ?>
<div class="alert alert-error mb-4">
    <?= $message ?>
</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg space-y-4 max-w-lg">

    <input type="text" name="name" placeholder="Item Name"
           class="input input-bordered w-full" required>

    <select name="category" class="select select-bordered w-full" required>
        <option disabled selected>Select Category</option>
        <option>Meals</option>
        <option>Snacks</option>
        <option>Drinks</option>
    </select>

    <input type="number" step="0.01" name="price" placeholder="Price"
           class="input input-bordered w-full" required>

    <textarea name="description" placeholder="Description"
              class="textarea textarea-bordered w-full"></textarea>

    <input type="file" name="image" class="file-input file-input-bordered w-full" required>

    <button class="btn btn-primary w-full">Add Item</button>
</form>
<br>
<a href="manage_menu.php"
   class="inline-block mb-6 px-6 py-3 rounded-full 
          bg-blue-600 hover:bg-blue-700 
          text-white font-semibold shadow-lg 
          hover:shadow-blue-500/50 transition duration-300">
    ← Back to Menu Management
</a>

</body>
</html>