<?php
include_once "./clases/customer.php";
require_once "./utils.php";

if (!isset($_POST["firstName"])|!isset($_POST["surname"])|!isset($_POST["userName"])|!isset($_POST["password"])|!isset($_POST["customerType"])) {
    header("location:./register.php");
}

$customer= new customer($_POST["userName"],$_POST["password"],$_POST["customerType"],$_POST["firstName"],$_POST["surname"]);

if (addCustomer($customer)) {
    // Si el usuario se crea correctamenteee
    echo "<h2>User created correctly, you will be redirected in 5 seconds</h2>";
    header("Refresh: 5; URL=./index.php");
} else {
    // Si ocuerre un error
    echo "<h2>Error creating user. Please try again.</h2>";
    header("Refresh: 5; URL=./register.php");
}