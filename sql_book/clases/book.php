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

public static function fromIsbn($isbn){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $stmt = $con->prepare("SELECT * FROM book WHERE isbn = :isbn");
    $stmt->execute(['isbn' => $isbn]);
    $book=$stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($book);

    return new self($book["isbn"],$book["title"],$book["author"],$book["stock"],$book["price"]);
}

public static function fromId($id){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $stmt = $con->prepare("SELECT * FROM book WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $book=$stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($book);

    return new self($book["isbn"],$book["title"],$book["author"],$book["stock"],$book["price"]);
}
function  __get($name)
{
    return $this->$name;
}
function deleteBook(){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $stmt1 = $con->prepare("DELETE FROM borrowed_books WHERE book_id = :id");
    $stmt1->execute(["id" => $this->getBookId($this->isbn)]);

    $stmt = $con->prepare("DELETE FROM book WHERE isbn = :isbn");
    $result = $stmt->execute(["isbn" => $this->isbn]);

    return $result;
}

function insetBook(){
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

function rentBook(){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();
    $stmt = $con->prepare("INSERT INTO borrowed_books (book_id, customer_id,start,:end) VALUES (:book_id, :customer_id, :start,:end)");

    $stmt2 = $con->prepare("UPDATE book SET stock = stock - 1 WHERE isbn = :isbn");
    try{
        $stmt->execute([
            'book_id' => $this->getBookId($this->isbn),
            'customer_id' => $_SESSION["id"],
            'start' => date("Y-m-d"),
            'end' => date("Y-m-d", strtotime("+1 month"))
        ]);
        $stmt2->execute(['isbn' => $this->isbn]);
        echo "Libro alquilado";
    }catch(PDOException $e){
        echo "Error al alquilar el libro";
    }

}
function getBookId($isbn){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();
    $stmt = $con->prepare("SELECT id FROM book WHERE isbn = :isbn");
    $stmt->execute(['isbn' => $isbn]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);
    return $id["id"];   
}

function allBook($all){
 $conObj = new DBconnection();
 $con=$conObj->getConnect();
$stmt = $con->prepare("SELECT title,id,author FROM book") ->fetchAll(PDO::FETCH_ASSOC);

foreach ($stmt as $book) {
   print(
   "<form action=\"#\" method=\"POST\">"
    ."<input type=\"hidden\" name=\"id\" value=\"".$book["id"]."\">"
    ."<input type=\"submit\" name=\"chosenBook\" value=\"".$book["id"]."\">"
    ."<div>"
    .$book["title"]
    ."</div>"
    ."</input>"
    ."<input type=\"hidden\" name=\"".$all."\"/>"
    ."</form>"
        );
    }    
}

function showBookById($id){
    $book =Book::fromId($id);
    print("<p>".$book->title."<p>");
}


}