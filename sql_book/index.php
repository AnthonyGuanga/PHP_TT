<?php

require_once "DBConnection.php";
require_once "customer.php";
$db = new DBConnection();
$con = new Customer();
$connection = $db->getConnection();

$db->createTablas();

$db->insertData("book",[
"id"=> 1,
"isbn"=> 978-3-16-1484,
"title"=> "Harry Potter y la piedra filosofal",
"author"=> "J. K. Rowling",
"stock"=> 5, 
"price"=> 15.99
]);


$email = "anthony@gmail.com";
if($con->userExiste($email)){
    echo "El usuario existe";
}
    else{
    echo "El usuario no existe";
    }

echo "<h1>Menu de usuarios</h1>";
echo <<< eot
<form action="customer.php" method="post">
    Ingrese su nombre : <input type="text" name="nombre" placeholder="Nombre"></br>
    Ingrese su contraseña : <input type="text" name="contrasenia" placeholder="Contraseña"></br>
    <input type="submit" value="Premium" name="premium"><input type="submit" value="Basic" name="basic">
</form>
eot;