<?php
session_start();

// Verifica si el usuario ya ha iniciado sesión
if (isset($_SESSION['customer_id'])) {
    header("Location: main.php");
    exit();
}

require_once 'customer.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $customer = new Customer();
    $user = $customer->validateCustomer($email, $password);

    if ($user) {
        $_SESSION['customer_id'] = $user['id'];
        $_SESSION['customer_name'] = $user['firstname'] . ' ' . $user['surname'];
        $_SESSION['customer_type'] = $user['type'];

        // Redirige a diferentes vistas según el tipo de usuario
        if ($user['type'] === 'premium') {
            header("Location: main.php");
        } else {
            header("Location: main.php");
        }
        exit();
    } else {
        $errorMessage = "Correo electrónico o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a la Biblioteca</h1>
    </header>

    <main>
        <form action="" method="POST">
            <h2>Iniciar sesión</h2>
            <?php if ($errorMessage): ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>

        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.</p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Biblioteca</p>
    </footer>
</body>
</html>
