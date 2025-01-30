<?php

require_once "utils.php";
spl_autoload_register('classAutoLoader');
class Book{
private $isbn;
private $title;
private $author;
private $stock;
private $price;

public function __construct($isbn = null, $title= null, $author= null,$stock= null,$price= null){
    $this->isbn=$isbn;
    $this->title=$title;
    $this->author=$author;
    $this->stock=$stock;
    $this->price=$price;
}

public function inserterLibrros(){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();
    $stmt = $con->prepare("INSERT INTO book (isbn, title, author, stock, price) VALUES (:isbn, :title, :author, :stock, :price)");
    try{
        $stmt->execute([
            'isbn' => $this->isbn,
            'title' => $this->title,
            'author' => $this->author,
            'stock' => $this->stock,
            'price' => $this->price
        ]);
        echo "Libro insertado";
    }catch(PDOException $e){
        echo "Error al insertar el libro";
    }
}


    
}


