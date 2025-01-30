<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Libro</title>
</head>
<body>
    <h1>Crear Libro</h1>
    <form action="controllers/BookController.php?action=create" method="POST">
        ISBN: <input type="text" name="isbn" required><br>
        Título: <input type="text" name="title" required><br>
        Autor: <input type="text" name="author" required><br>
        Stock: <input type="number" name="stock" required><br>
        Precio: <input type="number" step="0.01" name="price" required><br>
        <button type="submit">Crear</button>
    </form>
    <a href="main.php">Volver</a>
</body>
</html>