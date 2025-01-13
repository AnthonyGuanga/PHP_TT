<?php
require_once 'DBConnection.php';

class Customer {
    private $connection;

    public function __construct() {
        $dbConnection = new DBConnection('config.json');
        $this->connection = $dbConnection->dbConnect();
    }

    /**
     * Verifica si un usuario existe y si su contraseña es correcta.
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function authenticate($email, $password) {
        $query = "SELECT id, firstname, surname, type FROM customer WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($query);

        $hashedPassword = md5($password);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Registra un nuevo cliente en la base de datos.
     * @param string $firstname
     * @param string $surname
     * @param string $email
     * @param string $password
     * @param string $type
     * @return bool
     */
    public function register($firstname, $surname, $email, $password, $type) {
        $query = "INSERT INTO customer (firstname, surname, email, password, type) VALUES (:firstname, :surname, :email, :password, :type)";
        $stmt = $this->connection->prepare($query);

        $hashedPassword = md5($password);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Obtiene los detalles de un cliente por su ID.
     * @param int $customerId
     * @return array|null
     */
    public function getCustomerById($customerId) {
        $query = "SELECT id, firstname, surname, email, type FROM customer WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Comprueba si un correo ya está registrado.
     * @param string $email
     * @return bool
     */
    public function isEmailTaken($email) {
        $query = "SELECT id FROM customer WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
