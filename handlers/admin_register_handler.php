<?php
require_once "../Classes/Admin.php";

$admin = new Admin();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passcode = $_POST['admin_passcode'];

if ($passcode !== "cafeteria2025") {
    header("Location: ../pages/admin_register.php?error=passcode");
    exit;
}

$result = $admin->register($name, $email, $password);

if ($result === "success") {
    header("Location: ../public/admin/login.php?success=registered");
} elseif ($result === "email_exists") {
    header("Location: ../pages/admin_register.php?error=exists");
} else {
    header("Location: ../pages/admin_register.php?error=failed");
}
?>