<?php
require_once "Connection.php";

class Admin extends Dbh
{
    public function register($name, $email, $password)
{
    $conn = $this->connect();

    // check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return "email_exists";
    }

    // insert admin
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $name, $email, $hashed);

    if ($stmt->execute()) {
        return "success";
    }

    return "failed";
}

    public function login($email, $password)
    {
        session_start();
        $conn = $this->connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return "not_found";
        }

        $row = $result->fetch_assoc();

        if ($row['role'] !== "admin") {
            return "not_admin";
        }

        if (!password_verify($password, $row['password'])) {
            return "wrong_password";
        }

        // login success
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];

        return "success";
    }
}
?>