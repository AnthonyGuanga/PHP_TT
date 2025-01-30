<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if(isset($_SESSION['error'])): ?>
        <div style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    
    <form action="controllers/AuthController.php" method="POST">
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Ingresar</button>
    </form>
    <a href="register.php">Registrarse</a>
</body>
</html>