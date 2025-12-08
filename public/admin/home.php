<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        background: url('../images/cafeteria.jpeg') center/cover no-repeat fixed;
    }


    .glass-box {
        background: rgba(0, 0, 0, 0.64);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .menu-btn {
        background: rgba(41, 40, 40, 0.06);
        backdrop-filter: blur(8px);
        transition: 0.3s;
    }

    .menu-btn:hover {
        background: rgba(255, 255, 255, 0.5);
        scale: 1.03;
    }
</style>
</head>

<body>

<div class="overlay"></div>

<div class="flex justify-center items-center min-h-screen px-4">

    <div class="glass-box p-10 rounded-3xl shadow-2xl max-w-3xl w-full text-white relative z-10">

        <h1 class="text-6xl font-bold mb-3">Welcome, Admin!</h1>
        <p class="text-white-100 text-lg mb-8">Manage the cafeteria system efficiently.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="manage_menu.php" class="menu-btn p-6 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold">🍽 Manage Menu</h2>
                <p>View, edit, delete & add menu items</p>
            </a>

            <a href="orders.php" class="menu-btn p-6 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold">📦 Orders</h2>
                <p>View customer orders</p>
            </a>

            <a href="inventory_logs.php" class="menu-btn p-6 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold">📊 Inventory Logs</h2>
                <p>Track stock usage</p>
            </a>

            <a href="payments.php" class="menu-btn p-6 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold">💳 Payments</h2>
                <p>View completed transactions</p>
            </a>

        </div>

        <div class="mt-10 text-center">
           
        <a href="../../pages/home.php" 
   class="absolute bottom-5 right-5
          px-9 py-2 rounded-xl
          backdrop-blur-lg bg-white/20
          text-white font-semibold 
          border border-white/30
          hover:bg-white/30 hover:border-white/50
          transition duration-300">
   Logout
</a>
            
        </div>

    </div>

</div>

</body>
</html>