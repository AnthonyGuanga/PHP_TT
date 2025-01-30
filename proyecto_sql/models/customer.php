<?php
class Customer {
    private $conn;
    private $table = 'customer';

    public $id;
    public $firstname;
    public $surname;
    public $email;
    public $type;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function login() {
    
        $query = "SELECT id, type FROM " . $this->table_name . " WHERE email = ? AND password = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);

        $stmt->bindParam(2, $this->password);

        $stmt->execute();



        if($stmt->rowCount() == 1) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];

            $this->type = $row['type'];

            return true;

        } else {

            return false;

        }

    }
    // Crear un cliente
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET firstname = :firstname, surname = :surname, 
                      email = :email, type = :type, password = :password";
        
        $stmt = $this->conn->prepare($query);

        $this->password = md5($this->password); // Encriptar contraseña

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':password', $this->password);

        return $stmt->execute();
    }

    // Leer todos los clientes
    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un cliente por ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un cliente
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET firstname = :firstname, surname = :surname, 
                      email = :email, type = :type 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Eliminar un cliente
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>