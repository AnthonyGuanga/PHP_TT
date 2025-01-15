<?php
session_start();

// Verificar si el usuario está autenticado y es de tipo 'premium'
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'premium') {
    header("Location: login.php");
    exit();
}

require_once "DBConnection.php";

// Conexión a la base de datos
$db = new DBConnection("config.json");
$connection = $db->dbConnect();

// Verificar que se haya enviado el formulario correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id']) && isset($_POST['quantity'])) {
    $book_id = intval($_POST['book_id']);
    $quantity = intval($_POST['quantity']);
    $user_id = intval($_SESSION['user_id']);

    // Validar que los datos sean correctos
    if ($quantity > 0) {
        // Verificar si hay suficiente stock del libro
        $query = $connection->prepare("SELECT stock, price FROM book WHERE id = :book_id");
        $query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $query->execute();
        $book = $query->fetch(PDO::FETCH_ASSOC);

        if ($book && $book['stock'] >= $quantity) {
            // Registrar la venta
            $total_price = $quantity * $book['price'];
            $connection->beginTransaction();

            try {
                // Insertar en la tabla de ventas
                $sale_query = $connection->prepare(
                    "INSERT INTO sale (customer_id, date) VALUES (:customer_id, NOW())"
                );
                $sale_query->bindParam(':customer_id', $user_id, PDO::PARAM_INT);
                $sale_query->execute();

                // Obtener el ID de la venta recién creada
                $sale_id = $connection->lastInsertId();

                // Insertar en la tabla sale_book
                $sale_book_query = $connection->prepare(
                    "INSERT INTO sale_book (book_id, sale_id, amount) VALUES (:book_id, :sale_id, :amount)"
                );
                $sale_book_query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $sale_book_query->bindParam(':sale_id', $sale_id, PDO::PARAM_INT);
                $sale_book_query->bindParam(':amount', $quantity, PDO::PARAM_INT);
                $sale_book_query->execute();

                // Actualizar el stock del libro
                $update_stock_query = $connection->prepare(
                    "UPDATE book SET stock = stock - :quantity WHERE id = :book_id"
                );
                $update_stock_query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $update_stock_query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $update_stock_query->execute();

                // Confirmar la transacción
                $connection->commit();
                echo "Compra realizada con éxito. Total: $" . number_format($total_price, 2);
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $connection->rollBack();
                echo "Error al procesar la compra: " . $e->getMessage();
            }
        } else {
            echo "No hay suficiente stock disponible.";
        }
    } else {
        echo "Cantidad inválida.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
