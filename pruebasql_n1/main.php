<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'books.php';

$books = new Books();
$allBooks = $books->getAllBooks();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a la Biblioteca</h1>
        <nav>
            <a href="logout.php">Cerrar sesión</a>
            <a href="add_book.php">Añadir libro</a>
            <a href="my_books.php">Mis libros</a>
        </nav>
    </header>

    <main>
        <h2>Listado de libros</h2>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allBooks as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                        <td><?php echo number_format($book['price'], 2); ?> &euro;</td>
                        <td><?php echo htmlspecialchars($book['stock']); ?></td>
                        <td>
                            <a href="borrow_book.php?id=<?php echo $book['id']; ?>">Alquilar</a> |
                            <a href="buy_book.php?id=<?php echo $book['id']; ?>">Comprar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Biblioteca</p>
    </footer>
</body>
</html>
