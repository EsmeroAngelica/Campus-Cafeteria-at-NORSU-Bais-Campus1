<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">

<div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-2xl font-bold text-center mb-4">Admin Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error mb-3">
                <?php
                    if ($_GET['error'] == "empty") echo "Fill in all fields.";
                    if ($_GET['error'] == "wrong") echo "Incorrect password.";
                    if ($_GET['error'] == "notadmin") echo "Not an admin account.";
                    if ($_GET['error'] == "notfound") echo "Email not found.";
                ?>
            </div>
        <?php endif; ?>

        <form action="../../handlers/admin_login.php" method="POST" class="space-y-4">
            <input type="email" name="email" placeholder="Admin Email" class="input input-bordered w-full" required>

            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full" required>

            <button type="submit" name="admin_login" class="btn btn-primary w-full">
                Login
            </button>
        </form>

    </div>
</div>

</body>
</html>