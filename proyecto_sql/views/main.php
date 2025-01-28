<!-- views/main.php -->
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirigir si no hay sesión
}
?>
<h1>Bienvenido, <?php echo $_SESSION['user']['name']; ?></h1>
<!-- Aquí puedes agregar opciones para insertar, ver, actualizar o eliminar libros -->