<?php
session_start();

// Verificar si el usuario está autenticado y es de tipo 'basic'
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'basic') {
    header("Location: login.php");
    exit();
}

require_once "DBConnection.php";

// Conexión a la base de datos
$db = new DBConnection("config.json");
$connection = $db->dbConnect();

// Obtener los libros disponibles
$query = $connection->prepare("SELECT * FROM book");
$query->execute();
$books = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Basic</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user_name']) ?> (Usuario Basic)</h1>
        <nav>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Libros disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id']) ?></td>
                            <td><?= htmlspecialchars($book['isbn']) ?></td>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['stock']) ?></td>
                            <td>$<?= number_format($book['price'], 2) ?></td>
                            <td>
                                <?php if ($book['stock'] > 0): ?>
                                    <form action="borrow_book.php" method="post" style="display:inline;">
                                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                        <button type="submit">Alquilar</button>
                                    </form>
                                <?php else: ?>
                                    <span>Agotado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Mis libros</h2>
            <a href="my_books.php">Ver libros prestados</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Librería Basic</p>
    </footer>
</body>
</html>
