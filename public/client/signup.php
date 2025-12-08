<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-xl w-96">

        <h2 class="text-2xl font-bold text-center mb-4">Create Account</h2>

        <input type="text" id="signup_name" placeholder="Full Name"
               class="input input-bordered w-full mb-3">

        <input type="email" id="signup_email" placeholder="Email"
               class="input input-bordered w-full mb-3">

        <input type="password" id="signup_password" placeholder="Password"
               class="input input-bordered w-full mb-4">

        <button class="btn btn-primary w-full btn-signup">Sign Up</button>

        <p class="mt-4 text-center text-sm">
            Already have an account?
            <a href="login.php" class="text-blue-600">Login</a>
        </p>
    </div>
</div>

<script src="../../assets/js/jquery.js"></script>

<script>
$(".btn-signup").on("click", function() {

    let name = $("#signup_name").val();
    let email = $("#signup_email").val();
    let password = $("#signup_password").val();

    $.ajax({
        url: "../../handlers/signup_handler.php",
        method: "POST",
        data: {
            signup: true,
            name: name,
            email: email,
            password: password
        },
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.success);
                window.location.href = "login.php";
            } else {
                alert(res.error);
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert("Signup failed. Check signup_handler.php path.");
        }
    });
});
</script>

</body>
</html>