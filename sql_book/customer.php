<?php
require_once "DBConnection.php";
class customer{
    private $id;
    private $firstname;
    private $surname;
    private $email;
    private $type;


    public function __construct($id = null, $firstname = null, $surname = null, $email = null, $type = null){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->email = $email;
        $this->type = $type;
    }

    //Conprobar si el usuario existe en la base de datos 
    public function userExiste($firstname){
          
                $connObj = new DBConnection();
                $conn = $connObj->getConnection();
                $sql = "SELECT * FROM customer WHERE firstname = :firstname";
                $stmt = $conn->prepare($sql);
    
                $stmt->execute(['firstname' => $firstname]);
                //var_dump($stmt);
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                //var_dump($customer);
                if($customer){
                    return true;
                }   
}
}