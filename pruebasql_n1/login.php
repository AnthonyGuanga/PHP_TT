<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: main.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : null;
$success = isset($_GET['success']) ? $_GET['success'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo CSS si lo necesitas -->
</head>
<body>
    <div class="login-container">
        <h1>Inicio de Sesión</h1>

        <?php if ($error === "incorrect_password"): ?>
            <p class="error">Contraseña incorrecta. Inténtalo de nuevo.</p>
        <?php elseif ($success === "registered"): ?>
            <p class="success">Registro exitoso. Por favor, inicia sesión.</p>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.</p>
    </div>
</body>
</html>
