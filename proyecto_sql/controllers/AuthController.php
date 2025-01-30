<?php
session_start();
require_once '../config/Database.php';
require_once '../models/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($_GET['action'] == 'login') {
    $customer->email = $_POST['email'];
    $customer->password = $_POST['password'];
    
    if($customer->login()) {
        $_SESSION['user_id'] = $customer->id;
        $_SESSION['user_type'] = $customer->type;
        header("Location: ../views/main.php");
    } else {
        $_SESSION['error'] = "Credenciales inválidas";
        header("Location: ../views/login.php");
    }
}

if($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: ../views/login.php");
}
?>