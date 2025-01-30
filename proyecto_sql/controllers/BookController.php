<?php
session_start();
require_once '../config/Database.php';
require_once '../models/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

if ($_GET['action'] == 'create') {
    $book->isbn = $_POST['isbn'];
    $book->title = $_POST['title'];
    $book->author = $_POST['author'];
    $book->stock = $_POST['stock'];
    $book->price = $_POST['price'];

    if ($book->create()) {
        $_SESSION['message'] = "Libro creado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al crear el libro.";
    }
    header("Location: ../views/main.php");
}

if ($_GET['action'] == 'update') {
    $book->id = $_POST['id'];
    $book->isbn = $_POST['isbn'];
    $book->title = $_POST['title'];
    $book->author = $_POST['author'];
    $book->stock = $_POST['stock'];
    $book->price = $_POST['price'];

    if ($book->update()) {
        $_SESSION['message'] = "Libro actualizado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al actualizar el libro.";
    }
    header("Location: ../views/main.php");
}

if ($_GET['action'] == 'delete') {
    $book->id = $_GET['id'];

    if ($book->delete()) {
        $_SESSION['message'] = "Libro eliminado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el libro.";
    }
    header("Location: ../views/main.php");
}
?>