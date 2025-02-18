<?php
include_once "./clases/Customer.php";
require_once "./utils.php";

if(!isset($_POST["firsname"])|!isset($_POST["surname"])|!isset($_POST["email"])|!isset($_POST["password"])|!isset($_POST["type"])){
    header("location:./register.php");
}
$customer= new Customer($_POST["email"],$_POST["password"],$_POST["type"],$_POST["firsname"],$_POST["surname"]);

if(addCustomer($customer)){
    echo "<h2>User created correctly, you will be redirected in 5 seconds</h2>";
    header("Refresh: 5; URL=./index.php");
} else {    
    echo "<h2>Error creating user. Please try again.</h2>";
    header("Refresh: 5; URL=./register.php");
}