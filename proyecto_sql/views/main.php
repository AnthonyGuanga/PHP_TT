<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Libros</title>
</head>
<body>
    <h1>Libros</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <div style="color:green"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <a href="create_book.php">Agregar Libro</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php
        require_once '../models/Book.php';
        require_once '../config/Database.php';

        $database = new Database();
        $db = $database->getConnection();

        $book = new Book($db);
        $stmt = $book->read();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['isbn']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['stock']}</td>
                    <td>\${$row['price']}</td>
                    <td>
                        <a href='edit_book.php?id={$row['id']}'>Editar</a>
                        <a href='controllers/BookController.php?action=delete&id={$row['id']}'>Eliminar</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>