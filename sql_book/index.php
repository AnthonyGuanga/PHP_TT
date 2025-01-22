<?php

require_once "DBConnection.php";
require_once "customer.php";
$db = new DBConnection();
$con = new Customer();
$connection = $db->getConnection();

$db->createTablas();

$db->insertData("customer",[
"id"=> 1,
"firstname"=> "anthony",
"surname"=> "cristhian",
"email"=> "ninfrad@gmail.com",
"type"=> "premium"
]);

/* 
$email = 1;
if($con->userExiste($email)){
    echo "El usuario existe";
}
    else{
    echo "El usuario no existe";
    } */

header("Location: login.php");