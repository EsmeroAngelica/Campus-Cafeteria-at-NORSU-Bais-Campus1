<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-xl w-96">

        <h2 class="text-2xl font-bold text-center mb-4">Customer Login</h2>

        <input 
            type="email" 
            id="login_email" 
            placeholder="Email" 
            class="input input-bordered w-full mb-3"
        >

        <input 
            type="password" 
            id="login_password" 
            placeholder="Password" 
            class="input input-bordered w-full mb-4"
        >

        <button class="btn btn-primary w-full btn-login">Login</button>

        <p class="mt-4 text-center text-sm">
            Don't have an account?
            <a href="signup.php" class="text-blue-600">Sign Up</a>
        </p>

    </div>
</div>

<script src="../../assets/js/jquery.js"></script>

<!-- LOGIN AJAX -->
<script>
$(".btn-login").on("click", function (e) {
    e.preventDefault();

    let email = $("#login_email").val();
    let password = $("#login_password").val();

    $.ajax({
        url: "../../handlers/login_handler.php",
        method: "POST",
        data: {
            login: true,
            email: email,
            password: password
        },
        dataType: "json",
        success: function (res) {
            if (res.redirect) {
                window.location.href = res.redirect;
            } else if (res.error) {
                alert(res.error);
            } else {
                alert("Unexpected response from server.");
            }
        },
        error: function (xhr) {
            alert("Login failed. Check login_handler.php path.");
        }
    });
});
</script>

</body>
</html>