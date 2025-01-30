<?php
session_start();
require_once '../config/Database.php';
require_once '../models/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if ($_GET['action'] == 'create') {
    $customer->firstname = $_POST['firstname'];
    $customer->surname = $_POST['surname'];
    $customer->email = $_POST['email'];
    $customer->type = $_POST['type'];
    $customer->password = $_POST['password'];

    if ($customer->create()) {
        $_SESSION['message'] = "Cliente registrado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al registrar el cliente.";
    }
    header("Location: ../views/register.php");
}

if ($_GET['action'] == 'update') {
    $customer->id = $_POST['id'];
    $customer->firstname = $_POST['firstname'];
    $customer->surname = $_POST['surname'];
    $customer->email = $_POST['email'];
    $customer->type = $_POST['type'];

    if ($customer->update()) {
        $_SESSION['message'] = "Cliente actualizado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al actualizar el cliente.";
    }
    header("Location: ../views/main.php");
}

if ($_GET['action'] == 'delete') {
    $customer->id = $_GET['id'];

    if ($customer->delete()) {
        $_SESSION['message'] = "Cliente eliminado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el cliente.";
    }
    header("Location: ../views/main.php");
}
?>