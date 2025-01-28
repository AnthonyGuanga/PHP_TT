<?php
// controllers/books_controller.php
require_once '../config/database.php';
require_once '../models/books.php';

session_start();

$database = new Database();
$books = new Books($database->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $books->insert($_POST['title'], $_POST['author'], $_POST['price']);
    } elseif (isset($_POST['update'])) {
        $books->update($_POST['id'], $_POST['title'], $_POST['author'], $_POST['price']);
    } elseif (isset($_POST['delete'])) {
        $books->delete($_POST['id']);
    }
    header('Location: ../views/main.php');
}
?>