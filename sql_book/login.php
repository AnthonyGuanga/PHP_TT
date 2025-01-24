<?php 
require_once "customer.php";

$customer = new customer();
echo "<h1>Menu de usuarios</h1>";
echo <<< eot
<form action="#" method="post">
    Ingrese su nombre : <input type="text" name="nombre" placeholder="Nombre"></br>
    Ingrese su contraseña : <input type="text" name="contrasenia" placeholder="Contraseña"></br>
    <input type="submit" value="Premium" name="premium"><input type="submit" value="Basic" name="basic">
</form>
eot;

    $nombre = $_POST['nombre'];
    $contrasenia = $_POST['contrasenia'];
    if($customer->userExiste($nombre,$contrasenia)){
        echo "El usuario existe";
    }else{
        echo "El usuario no existe";
        header("Refresh:5, url=registre.php");
    } 

   
?>