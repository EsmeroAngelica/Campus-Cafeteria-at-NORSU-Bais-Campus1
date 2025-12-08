<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

$query = "SELECT * FROM menu_items ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Menu</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 p-10">

<h1 class="text-6xl font-bold mb-6">🍽 Manage Menu</h1>
<br></br>
<a href="add_menu_item.php"
   class="px-5 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
   + Add New Menu Item
</a>
<br></br>

<table class="mt-6 min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Image</th>
            <th class="p-3">Name</th>
            <th class="p-3">Category</th>
            <th class="p-3">Price</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="border-b">
            <td class="p-3"><?= $row['id'] ?></td>
            <td class="p-3">
                <img src="../images/<?= $row['image'] ?>" class="h-20 w-20 object-cover rounded">
            </td>
            <td class="p-3"><?= $row['name'] ?></td>
            <td class="p-3"><?= $row['category'] ?></td>
            <td class="p-3">₱<?= $row['price'] ?></td>

            <td class="p-4 flex gap-2">
    <a href="edit_item.php?id=<?= $row['id']; ?>" 
       class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 
              text-white rounded-lg text-sm">
        Edit
    </a>

    <a href="delete_item.php?id=<?= $row['id']; ?>" 
       class="px-4 py-2 bg-red-600 hover:bg-red-700 
              text-white rounded-lg text-sm"
       onclick="return confirm('Are you sure you want to delete this item?');">
        Delete
    </a>
</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<br>
<a href="home.php"
   class="inline-block mb-6 px-6 py-3 rounded-full 
          bg-blue-600 hover:bg-blue-700 
          text-white font-semibold shadow-lg 
          hover:shadow-blue-500/50 transition duration-300">
    ← Back to Admin Home
</a>

</body>
</html>