<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <div style="color:green"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="controllers/CustomerController.php?action=create" method="POST">
        Nombre: <input type="text" name="firstname" required><br>
        Apellido: <input type="text" name="surname" required><br>
        Email: <input type="email" name="email" required><br>
        Tipo: 
        <select name="type" required>
            <option value="basic">Basic</option>
            <option value="premium">Premium</option>
        </select><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrarse</button>
    </form>
    <a href="login.php">Iniciar Sesión</a>
</body>
</html>