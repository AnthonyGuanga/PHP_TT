<?php
class Customer
{
    private static $lastId = 0;
    private $id;
    private $name;
    private $surnames;
    private $email;

    public function __construct($name, $surnames, $email)
    {
        $this->id=self::$lastId+100;
        self::$lastId++;
        $this->name = $name;
        $this->surnames = $surnames;
        $this->email = $email;
    }

    public function __tostring()
    {
        return "<table style=\"border:1px solid black; margin-top:5px; border-collapse: collapse;\">

        <thead><tr style=\"background-color:lightgreen\"><th>Customer: " . $this->name . "</th></tr></thead>
        
        <tr style=\"background-color:cornsilk\"><td>ID: </td><td >" . $this->id . "</td></tr>

        <tr style=\"background-color:rgb(255,248,178)\"><td>Surnames: </td><td >" . $this->surnames . "</td></tr>

        <tr style=\"background-color:cornsilk\"><td>Email: </td><td >" . $this->email . "</td></tr>
       
        </table>";
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurnames()
    {
        return $this->surnames;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSurnames($surnames)
    {
        $this->name = $surnames;
    }

    public function setEmail($email)
    {
        $this->name = $email;
    }

}

