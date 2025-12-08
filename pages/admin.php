<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .hero-bg {
            background: url('../public/images/cafe_back.jpg') center/cover no-repeat;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.45);
        }
    </style>
</head>

<body>

<div class="hero-bg w-full h-screen">
    <div class="overlay w-full h-full flex items-center justify-center px-4">

        <div class="bg-white/20 backdrop-blur-xl p-10 rounded-3xl shadow-2xl max-w-lg w-full">

            <h1 class="text-4xl font-bold text-black mb-2">Admin Access</h1>
            <p class="text-gray-200 mb-6 max-w-md">
                Manage the cafeteria system, update menus, handle orders, and oversee all administrative tasks.
            </p>

            <p class="text-black-300 uppercase tracking-widest mb-4 text-sm font-semibold">
                Choose an option
            </p>

            <div class="space-y-4">

                <a href="../public/admin/login.php"
                    class="flex items-center gap-4 bg-white/20 hover:bg-white/30 
                           p-4 rounded-xl backdrop-blur-x5 cursor-pointer transition">

                    <div class="text-white text-xl"></div>
                    <div>
                        <h2 class="text-black font-semibold">Admin Login</h2>
                        <p class="text-gray-200 text-sm">Sign in to manage the system</p>
                    </div>
                </a>

                <a href="admin_register.php"
                    class="flex items-center gap-4 bg-white/20 hover:bg-white/30 
                           p-4 rounded-xl backdrop-blur-x5 cursor-pointer transition">

                    <div class="text-white text-xl"></div>
                    <div>
                        <h2 class="text-black font-semibold">Register Admin</h2>
                        <p class="text-gray-200 text-sm">Create an admin account</p>
                    </div>
                </a>

            </div>

            <div class="mt-6 text-center">
                <a href="home.php" class="text-blue-200 hover:underline">
                    ← Back to Home
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>