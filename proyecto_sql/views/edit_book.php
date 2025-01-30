<?php session_start(); 
require_once '../models/Book.php';
require_once '../config/Database.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);
$book->id = $_GET['id'];
$row = $book->readOne();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Libro</title>
</head>
<body>
    <h1>Editar Libro</h1>
    <form action="controllers/BookController.php?action=update" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        ISBN: <input type="text" name="isbn" value="<?= $row['isbn'] ?>" required><br>
        Título: <input type="text" name="title" value="<?= $row['title'] ?>" required><br>
        Autor: <input type="text" name="author" value="<?= $row['author'] ?>" required><br>
        Stock: <input type="number" name="stock" value="<?= $row['stock'] ?>" required><br>
        Precio: <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="main.php">Volver</a>
</body>
</html>