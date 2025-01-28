<?php
// models/customer.php
class Customer {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($email, $password) {
        $password_md5 = md5($password);
        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password_md5]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password, $type = 'Basic') {
        $password_md5 = md5($password);
        $stmt = $this->conn->prepare("INSERT INTO customers (name, email, password, type) VALUES (:name, :email, :password, :type)");
        return $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password_md5, 'type' => $type]);
    }
}
?>