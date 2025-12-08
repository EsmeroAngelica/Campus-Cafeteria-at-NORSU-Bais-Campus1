<?php
require_once "Connection.php";

class Client extends Dbh
{
    // SIGN UP CUSTOMER
    public function signup($name, $email, $hashed_password)
    {
        $conn = $this->connect();

        // check existing email
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            return 2; // email already exists
        }

        // insert customer
        $stmt = $conn->prepare("
            INSERT INTO users (name, email, password, role)
            VALUES (?, ?, ?, 'customer')
        ");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        return $stmt->execute() ? 1 : 0;
    }

    // LOGIN CUSTOMER
   public function login($email, $password) {
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return 0; // account not found
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        return 2; // wrong password
    }

    // SUCCESS — set session
    $_SESSION['user_id'] = $user['id'];

    return "/public/client/home.php";    // redirect location
}
}
?>