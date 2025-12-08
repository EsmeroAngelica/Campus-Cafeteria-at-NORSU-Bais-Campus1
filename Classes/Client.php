<?php
require_once "Connection.php";

class Client extends Dbh
{
    public function signup($name, $email, $hashed_password)
    {
        $conn = $this->connect();

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            return 2; 
        }

        $stmt = $conn->prepare("
            INSERT INTO users (name, email, password, role)
            VALUES (?, ?, ?, 'customer')
        ");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        return $stmt->execute() ? 1 : 0;
    }

   public function login($email, $password) {
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return 0; 
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        return 2; 
    }

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];
$_SESSION['user_name'] = $user['name'];

return "/system_analysis/public/client/home.php"; 
}
}
?>