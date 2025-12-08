<?php
require_once "../Classes/Connection.php";
require_once "../Classes/Admin.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passcode = $_POST['passcode'];
    $password = $_POST['password'];

    if ($passcode !== "cafeteria2025") {
        $message = "❌ Invalid Admin Passcode!";
    } else {
        $admin = new Admin();
        $result = $admin->register($name, $email, $password);

        if ($result === "email_exists") {
            $message = "⚠ Email is already used!";
       } else if ($result === "success") {
    $message = "✅ Admin Account Created Successfully! Redirecting to login...";

    echo "<div class='alert alert-success' style='margin: 20px; font-size: 18px;'>{$message}</div>";

    echo "<script>
            setTimeout(function() {
                window.location.href = '../public/admin/login.php?success=registered';
            }, 3000);
          </script>";

    exit;
} else {
            $message = "⚠ Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .hero-bg {
            background: url('../public/images/cafe.jpg') center/cover no-repeat;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.55);
        }
    </style>
</head>

<body>
<div class="hero-bg w-full h-screen">
    <div class="overlay w-full h-full flex items-center justify-center px-4">

        <div class="bg-white/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl max-w-md w-full">

            <h2 class="text-3xl font-extrabold text-gray-800 mb-3 text-center">
                Admin Registration
            </h2>

            <p class="text-gray-600 text-center mb-6">
                Only users with the admin passcode can create an admin account.
            </p>

            <?php if ($message): ?>
                <div class="alert alert-warning shadow mb-4">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">

                <input type="text" name="name" placeholder="Full Name"
                       class="input input-bordered w-full" required>

                <input type="email" name="email" placeholder="Email"
                       class="input input-bordered w-full" required>

                <input type="text" name="passcode" placeholder="Admin Passcode"
                       class="input input-bordered w-full" required>

                <input type="password" name="password" placeholder="Password"
                       class="input input-bordered w-full" required>

                <button class="btn btn-primary w-full text-lg mt-2">
                    Register Admin
                </button>
            </form>

            <div class="text-center mt-5">
                <a href="admin.php" class="text-blue-600 hover:underline">
                    ← Back to Admin Menu
                </a>
                <br>
                <a href="home.php" class="text-gray-500 hover:underline">
                    ← Back to Home
                </a>
            </div>

        </div>

    </div>
</div>
</body>
</html>