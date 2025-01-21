<?php

require_once "DBConnection.php";
require_once "customer.php";

session_start();

$db = new DBConnection();
$connection = $db->getConnection();
$customer = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($customer->userExiste($email)) {
        if ($customer->verifyPassword($email, $password)) {
            $_SESSION['email'] = $email;
            $userType = $customer->getUserType($email);
            $_SESSION['userType'] = $userType;
            if ($userType == 'Premium') {
                header("Location: ../views/premium.php");
            } else {
                header("Location: ../views/basic.php");
            }
        } else {
            header("Location: ../views/login.php?error=incorrect_password");
        }
    } else {
        header("Location: ../views/register.php");
    }
}
?>