<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: main.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo CSS si lo necesitas -->
</head>
<body>
    <div class="register-container">
        <h1>Registro de Usuario</h1>

        <?php if ($error === "registration_failed"): ?>
            <p class="error">El registro falló. Por favor, inténtalo de nuevo.</p>
        <?php endif; ?>

        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="firstname">Nombre:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="surname">Apellido:</label>
                <input type="text" id="surname" name="surname" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="type">Tipo de Usuario:</label>
                <select id="type" name="type" required>
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                </select>
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
    </div>
</body>
</html>
