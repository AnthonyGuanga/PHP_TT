<?php

require_once "DBConnection.php";
$db = new DBConnection();

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

