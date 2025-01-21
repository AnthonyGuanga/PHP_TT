<?php

class Customer {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function userExiste($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function verifyPassword($email, $password) {
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $password = md5($password);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function getUserType($email) {
        $query = "SELECT type FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['type'];
    }

    public function registerUser($firstname, $surname, $email, $password, $type) {
        $query = "INSERT INTO users (firstname, surname, email, password, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $password = md5($password);
        $stmt->bind_param("sssss", $firstname, $surname, $email, $password, $type);
        return $stmt->execute();
    }
}
?>