<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "DBConnection.php";

// Conexión a la base de datos
$db = new DBConnection("config.json");
$connection = $db->dbConnect();

// Obtener el ID del usuario autenticado
$user_id = intval($_SESSION['user_id']);

// Consultar libros comprados por el usuario
$purchasedBooksQuery = $connection->prepare("
    SELECT b.title, b.author, sb.amount, s.date 
    FROM sale s
    JOIN sale_book sb ON s.id = sb.sale_id
    JOIN book b ON sb.book_id = b.id
    WHERE s.customer_id = :user_id
    ORDER BY s.date DESC
");
$purchasedBooksQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$purchasedBooksQuery->execute();
$purchasedBooks = $purchasedBooksQuery->fetchAll(PDO::FETCH_ASSOC);

// Consultar libros alquilados por el usuario
$borrowedBooksQuery = $connection->prepare("
    SELECT b.title, b.author, bb.start, bb.end 
    FROM borrowed_books bb
    JOIN book b ON bb.book_id = b.id
    WHERE bb.customer_id = :user_id
    ORDER BY bb.start DESC
");
$borrowedBooksQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$borrowedBooksQuery->execute();
$borrowedBooks = $borrowedBooksQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Libros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Mis Libros</h1>
        <nav>
            <a href="index_premium.php">Inicio</a>
            <a href="logout.php">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Libros Comprados</h2>
            <?php if (!empty($purchasedBooks)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Cantidad</th>
                            <th>Fecha de Compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchasedBooks as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['title']) ?></td>
                                <td><?= htmlspecialchars($book['author']) ?></td>
                                <td><?= intval($book['amount']) ?></td>
                                <td><?= htmlspecialchars($book['date']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No has comprado ningún libro.</p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Libros Alquilados</h2>
            <?php if (!empty($borrowedBooks)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($borrowedBooks as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['title']) ?></td>
                                <td><?= htmlspecialchars($book['author']) ?></td>
                                <td><?= htmlspecialchars($book['start']) ?></td>
                                <td><?= htmlspecialchars($book['end'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No has alquilado ningún libro.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
