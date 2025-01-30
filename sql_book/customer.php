<?php
require_once "DBConnection.php";
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
    public function userExiste($firstname,$password){
          
                $connObj = new DBConnection();
                $conn = $connObj->getConnection();
                $sql = "SELECT * FROM customer WHERE firstname = :firstname AND password = :password";

                $stmt = $conn->prepare($sql);
                $stmt->execute(['firstname' => $firstname
                ,'password' => $password]);

                //var_dump($stmt);
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);

                //var_dump($customer);
                if($customer){
                    var_dump($customer);
                    return true;
                }            
        }
public function getBook() {

    }
}