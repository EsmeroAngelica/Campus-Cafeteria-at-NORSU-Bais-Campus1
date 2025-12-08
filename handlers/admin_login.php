<?php
require_once "../Classes/Admin.php";

$admin = new Admin();

$email = $_POST['email'];
$password = $_POST['password'];

$result = $admin->login($email, $password);

if ($result === "success") {
    header("Location: ../public/admin/home.php");
    exit;
} elseif ($result === "wrong_password") {
    header("Location: ../public/admin/login.php?error=wrong");
} elseif ($result === "not_admin") {
    header("Location: ../public/admin/login.php?error=notadmin");
} elseif ($result === "not_found") {
    header("Location: ../public/admin/login.php?error=notfound");
}
?>