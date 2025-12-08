<?php
require_once "../Classes/Client.php";

header("Content-Type: application/json");

if (isset($_POST['signup'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(["error" => "Please fill in all fields."]);
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $client = new Client();
    $result = $client->signup($name, $email, $hashed);

    if ($result == 1) {
        echo json_encode(["success" => "Account created successfully"]);
    } 
    elseif ($result == 2) {
        echo json_encode(["error" => "Email already exists"]);
    } 
    else {
        echo json_encode(["error" => "Failed to create account"]);
    }

    exit();
}
?>