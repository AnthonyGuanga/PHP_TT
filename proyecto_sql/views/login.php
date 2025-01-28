<!-- views/login.php -->
<form action="../controllers/login_controller.php" method="POST">
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
</form>
<?php if (isset($_GET['error'])) echo "<p>Usuario o contraseña incorrectos</p>"; ?>