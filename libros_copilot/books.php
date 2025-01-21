<?php

class Books {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function insertBook($isbn, $title, $author, $stock, $price) {
        $query = "INSERT INTO books (isbn, title, author, stock, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssdi", $isbn, $title, $author, $stock, $price);
        return $stmt->execute();
    }

    public function getAllBooks() {
        $query = "SELECT * FROM books";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteBook($id) {
        $query = "DELETE FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function rentBook($id, $customerName) {
        // Implementar lógica para alquilar un libro
    }

    public function returnBook($id) {
        // Implementar lógica para devolver un libro
    }

    public function getCustomerBooks($customerName) {
        // Implementar lógica para obtener libros de un cliente
    }
}
?>