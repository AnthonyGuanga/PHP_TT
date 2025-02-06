<?php
require_once __DIR__."/../utils.php";
spl_autoload_register('classAutoLoader');
class customer{
    private $id;
    private $firstname;
    private $surname;
    private $email;
    private $password;
    private $type;


    public function __construct($id = null, $firstname = null, $surname = null, $email = null, $password=null, $type = null){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }

    public function __get($name){
        return $this->$name;
    }

    public function userId($id){
            $connObj = new DBConnection();
            $conn = $connObj->getConnection();
            $sql = "SELECT * FROM customer WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            return new self($customer["id"],$customer["firstname"],$customer["surname"],$customer["email"],$customer["password"],$customer["type"]);
    }
    //Conprobar si el usuario existe en la base de datos 
    // public function userExiste($firstname,$password){
          
    //             $connObj = new DBConnection();
    //             $conn = $connObj->getConnection();
    //             $sql = "SELECT * FROM customer WHERE firstname = :firstname AND password = :password";

    //             $stmt = $conn->prepare($sql);
    //             $stmt->execute(['firstname' => $firstname
    //             ,'password' => $password]);

    //             //var_dump($stmt);
    //             $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    //             //var_dump($customer);
    //             if($customer){
    //                 var_dump($customer);
    //                 return true;
    //             }            
    //     }
public function getRentedBooks() {
    $connObj = new DBConnection();
    $conn = $connObj->getConnection();

    $stmt = $conn->prepare("SELECT book_id FROM borrowed_books WHERE customer_id = :customer_id AND end IS NULL");
    $stmt->execute(['customer_id' => $this->id]);

    $rentedBooksId = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rentedBooksId;
    }

public function returnBook($bookId){
    $book = Book::fromId($bookId);
    $connObj = new DBConnection();
    $conn = $connObj->getConnection();

    $oldestDate = $conn->prepare("SELECT MIN(start) FROM borrowed_books WHERE book_id = :book_id AND customer_id = :customer_id AND end IS NULL");
    $oldestDate->execute([
        "book_id" => $bookId,
        "customer_id" => $this->id
    ]);

    $oldestBorrowedBook = $oldestDate->fetch();

    $stmt = $conn->prepare("UPDATE borrowed_books SET end = :end WHERE book_id = :book_id AND customer_id = :customer_id AND start = :start");

    $stmt2= $conn->prepare("UPDATE book SET stock = :stock WHERE id = :book_id");
    $stmt2->execute([
        "stock" => $book->stock + 1,
        "book_id" => $bookId
    ]);
    $result = $stmt->execute([
        "end" => date("Y-m-d H:i:s"),
        "book_id" => $bookId,
        "customer_id" => $this->id,
        "start" => $oldestBorrowedBook->fetchColumn()
    ]);
    
   if($result){
       return "Book returned successfully";
    }else{  
        return "Error returning book";
    }
}

function buyBook($bookId, $price){
    $connObj = new DBConnection();
    $conn = $connObj->getConnection();
    
    $saleStmt = $conn->prepare("INSERT INTO sale (customer_id, date) VALUES (:customer_id, :date)");
    $date = date("Y-m-d H:i:s");
    $sale = $saleStmt->execute([
        "customer_id" => $this->id,
        "date" => $date
    ]);
    if($sale){
        $saleIdStmt = $conn->prepare("SELECT MAX(id) FROM sale WHERE customer_id = :customer_id AND date = :date");
        $saleIdStmt->execute([
            "customer_id" => $this->id,
            "date" => $date
        ]);
        $saleId = $saleIdStmt->fetch(PDO::FETCH_COLUMN);
        if($saleId){
            $rentedBooks = $conn->prepare("SELECT sale_book (:sale_id, :book_id,amount) VALUES(:sale_id, :book_id, :amount)");
            $rentedBooks->execute(["book_id" => $bookId, "sale_id" => $saleId["id"], "amount" => $price]);
            if($rentedBooks){
                return "Book bought successfully";
            }else{
                return "Error buying book";
            }
        }else{
            return "Error buying book";
        }

    }
    else{
        return "Error buying book";
    }
}

}