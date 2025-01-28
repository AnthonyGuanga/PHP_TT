<?php
// controllers/login_controller.php
require_once '../config/database.php';
require_once '../models/customer.php';

session_start();

$database = new Database();
$customer = new Customer($database->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $customer->login($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ../views/main.php');
    } else {
        header('Location: ../views/login.php?error=1');
    }
}
?>