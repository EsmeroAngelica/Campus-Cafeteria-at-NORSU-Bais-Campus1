<?php
header('Content-Type: application/json');

require_once "../Classes/Client.php";

$responseData = [];

try {
    if (!isset($_POST['login'])) {
        $responseData['error'] = "Invalid request.";
        echo json_encode($responseData);
        exit;
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $responseData['error'] = "Please fill in all fields.";
        echo json_encode($responseData);
        exit;
    }

    $client = new Client();
    $loginResult = $client->login($email, $password);

    if ($loginResult === 0) {
        $responseData['error'] = "Account not found.";
    } 
    elseif ($loginResult === 2) {
        $responseData['error'] = "Incorrect password.";
    } 
    else {
        // SUCCESS — return redirect link
        $responseData['redirect'] = $loginResult;
    }

    echo json_encode($responseData);
    exit;

} catch (Exception $e) {
    $responseData['error'] = "Server error: " . $e->getMessage();
    echo json_encode($responseData);
    exit;
}