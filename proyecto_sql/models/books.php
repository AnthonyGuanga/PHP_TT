<?php
// models/books.php
class Books {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($title, $author, $price) {
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, price) VALUES (:title, :author, :price)");
        return $stmt->execute(['title' => $title, 'author' => $author, 'price' => $price]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $author, $price) {
        $stmt = $this->conn->prepare("UPDATE books SET title = :title, author = :author, price = :price WHERE id = :id");
        return $stmt->execute(['id' => $id, 'title' => $title, 'author' => $author, 'price' => $price]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>