<!-- views/register.php -->
<form action="../controllers/register_controller.php" method="POST">
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>