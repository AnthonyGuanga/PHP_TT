<?php
require_once "DBConnection.php";

echo <<< eot
<h1>Registro de usuarios</h1>
<form action="#" method="post">
    <label>Nombre:
        <input type="text" name="nombre" required />
    </label>
    <br/>
    <label>Apellido:
        <input type="text" name="apellido" required />
    </label>
    <br/>
    <label>Email:
        <input type="email" name="email" required />
    </label>
    <br/>
    <label>Contraseña:
        <input type="password" name="contrasenia" required />
    </label>
    <br/>
    <input type="submit" name="submit" value="Confirm" />
</form>
eot;

if (isset($_POST["submit"])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasenia = $_POST['contrasenia'];
    $db = new DBConnection();
    $connexion = $db->getConnection();
    $db->insertData("customer", [
        "id" => 1,
        "firstname" => $nombre,
        "surname" => $apellido,
        "email" => $email,
        "type" => "premium",
        "password" => $contrasenia
    ]);
    var_dump($connexion);
    var_dump($db);
    echo "Usuario registrado";
    //header("Refresh:5, url=login.php");
}
