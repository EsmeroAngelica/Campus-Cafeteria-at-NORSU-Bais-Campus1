<?php
session_start();
require_once "../../Classes/Connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Dbh();
$conn = $db->connect();

$result = $conn->query("
    SELECT inventory_logs.*, menu_items.name 
    FROM inventory_logs
    JOIN menu_items ON inventory_logs.menu_id = menu_items.id
    ORDER BY inventory_logs.id DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-gray-100">

<h1 class="text-5xl font-bold mb-5">📊 Inventory Logs</h1>

<table class="table w-full bg-white shadow-lg">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Change</th>
            <th>Reason</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['change_amount'] ?></td>
            <td><?= $row['reason'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
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