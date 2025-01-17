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
}