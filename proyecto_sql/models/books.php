<?php
class Book {
    private $conn;
    private $table = 'book';

    public $id;
    public $isbn;
    public $title;
    public $author;
    public $stock;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un libro
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET isbn = :isbn, title = :title, author = :author, 
                      stock = :stock, price = :price";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':price', $this->price);

        return $stmt->execute();
    }

    // Leer todos los libros
    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un libro por ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un libro
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET isbn = :isbn, title = :title, author = :author, 
                      stock = :stock, price = :price 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Eliminar un libro
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>