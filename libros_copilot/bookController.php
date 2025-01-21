<?php

require_once "DBConnection.php";
require_once "books.php";

$db = new DBConnection();
$connection = $db->getConnection();
$books = new Books($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Implementar lógica para manejar operaciones CRUD
}
?>