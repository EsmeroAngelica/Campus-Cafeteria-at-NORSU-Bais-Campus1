<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

<style>

    /* Dark overlay */
    .overlay-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(4px);
        z-index: -1;
    }

    /* Welcome card */
    .welcome-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
        text-align: center;
        max-width: 700px;
        width: 100%;
        margin-bottom: 30px;
        animation: fadeIn 0.6s ease;
    }

    .welcome-title {
        font-size:50px; 
        font-weight: 800;
        color: #0e0b0bff;
    }

    .welcome-sub {
        font-size: 20px;
        margin-top: 20px;
        color: white;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>

<body>

<div class="overlay-bg"></div>

<div class="min-h-screen flex flex-col items-center pt-16 px-4">

    <!-- WELCOME CARD -->
    <div class="welcome-card">
        <h1 class="welcome-title">Welcome, <?= htmlspecialchars($name); ?>!</h1>
        <p class="welcome-sub">Ready to order? Explore our delicious menu below.</p>
    </div>

    <!-- MENU (keeps your card design, nothing touched inside menu.php) -->
    <div class="w-full max-w-7xl">
        <?php include "menu.php"; ?>
    </div>

</div>

</body>
</html>