<?php
require_once 'DBConnection.php';

class Books {
    private $connection;

    public function __construct() {
        $dbConnection = new DBConnection('config.json');
        $this->connection = $dbConnection->dbConnect();
    }

    /**
     * Obtiene todos los libros disponibles en la base de datos.
     * @return array
     */
    public function getAllBooks() {
        $query = "SELECT * FROM book";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Inserta un nuevo libro en la base de datos.
     * @param string $isbn
     * @param string $title
     * @param string $author
     * @param int $stock
     * @param float $price
     * @return bool
     */
    public function addBook($isbn, $title, $author, $stock, $price) {
        $query = "INSERT INTO book (isbn, title, author, stock, price) VALUES (:isbn, :title, :author, :stock, :price)";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Actualiza los datos de un libro existente.
     * @param int $id
     * @param string $isbn
     * @param string $title
     * @param string $author
     * @param int $stock
     * @param float $price
     * @return bool
     */
    public function updateBook($id, $isbn, $title, $author, $stock, $price) {
        $query = "UPDATE book SET isbn = :isbn, title = :title, author = :author, stock = :stock, price = :price WHERE id = :id";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Elimina un libro de la base de datos.
     * @param int $id
     * @return bool
     */
    public function deleteBook($id) {
        $query = "DELETE FROM book WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Busca un libro por su ID.
     * @param int $id
     * @return array|null
     */
    public function getBookById($id) {
        $query = "SELECT * FROM book WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza el stock de un libro.
     * @param int $id
     * @param int $quantity
     * @return bool
     */
    public function updateStock($id, $quantity) {
        $query = "UPDATE book SET stock = stock + :quantity WHERE id = :id";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
