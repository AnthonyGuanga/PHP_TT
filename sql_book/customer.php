<?php

class customer{
    private $id;
    private $firstname;
    private $surname;
    private $email;
    private $type;


    public function __construct($id, $firstname, $surname, $email, $type){
        $this->id = $id;
        $this->firstName = $firstname;
        $this->surname = $surname;
        $this->email = $type;
    }

    //Conprobar si el usuario existe en la base de datos
    public function userExsiste($email){
    
        if($this->conn){
            try{
                $sql = "SELECT COUNT(*) FROM customer WHRE email = :email";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam("email",$email); 
                $stmt->execute();
                $acount = $stmt->fetchColumn();
                return $acount > 0;
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            
            }
        }
        return false;
    }
}