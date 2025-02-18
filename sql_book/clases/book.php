<?php

require_once __DIR__."/../utils.php";
spl_autoload_register('classAutoLoader');
class Book{
private $isbn;
private $title;
private $author;
private $stock;
private $price;

public function __construct($isbn, $title, $author,$stock,$price ){
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

function __get($name){
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

function addBook(){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();
    $stmt = $con->prepare("INSERT INTO book (isbn, title,author,stock,price) VALUES (:isbn, :title, :author, :stock, :price)");
    try {
    $stmt->execute(['isbn' => $this->isbn, 'title' => $this->title, 'author' => $this->author, 'stock' => $this->stock, 'price' => $this->price, ]);
    return "Book inserted correctly";
    } catch (ErrorException $e) {
    return "Error inserting the book";
    }
    
}

function rentBook($customerId){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $stmt = $con->prepare("INSERT INTO borrowed_books (book_id, customer_id,start,end) VALUES (:book_id, :customer_id, :start, :end)");
    $id=$this->getBookId($this->isbn);

    $stmt2 = $con->prepare("UPDATE book SET stock = :stock WHERE isbn = :isbn ");
    
    try {
        $stmt->execute(['book_id' => $id, 'customer_id' => $customerId, 'start' => date('d-m-y H:i:s'), 'end' => null, ]);
        $stmt2->execute(["stock" => ($this->stock -1), 'isbn' => $this->isbn ]);
        return "Book rented correctly";
    } catch (Error $e) {
        return "Error in database when renting book";
    }

}

function getBookId($isbn){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $stmt = $con->prepare("SELECT id FROM book WHERE isbn = :isbn");
    $stmt->execute(['isbn' => $isbn]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($id);
    return $id["id"];
    }

}

function showAllBooks($opp){
    $conObj = new DBconnection();
    $con=$conObj->getConnect();

    $books = $con->query("SELECT title,id,author FROM book")->fetchAll();

    //var_dump($books);
    foreach ($books as $book) {
        print("<form action=\"#\" method=\"POST\">
        <input type=\"submit\" name=\"chosenBook\" value=\"".$book["id"]."\"
        <div>
        ".
        $book["title"]
        .
        "
        </div>
        </input>
        <input type=\"hidden\" name=\"".$opp."\"/>
        </form>
        ");
    }
}

function showBookById($id){
    
    $book=Book::fromId($id);
            
    print("<p>".$book->title."<p>");
    
}


