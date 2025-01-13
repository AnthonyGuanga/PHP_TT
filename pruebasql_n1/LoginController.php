<?php
require_once "DBConnection.php";

class LoginController {

    private $connection;

    public function __construct() {
        $db = new DBConnection("config.json");
        $this->connection = $db->dbConnect();
    }

    public function login($email, $password) {
        $query = $this->connection->prepare("SELECT * FROM customer WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (md5($password) === $user['password']) {
                // Login correcto
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['type'];
                header("Location: main.php");
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: login.php?error=incorrect_password");
                exit;
            }
        } else {
            // Usuario no encontrado
            header("Location: register.php");
            exit;
        }
    }

    public function register($firstname, $surname, $email, $password, $type) {
        $query = $this->connection->prepare(
            "INSERT INTO customer (firstname, surname, email, password, type) VALUES (:firstname, :surname, :email, :password, :type)"
        );

        $hashedPassword = md5($password);
        $query->bindParam(":firstname", $firstname);
        $query->bindParam(":surname", $surname);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $hashedPassword);
        $query->bindParam(":type", $type);

        if ($query->execute()) {
            header("Location: login.php?success=registered");
            exit;
        } else {
            header("Location: register.php?error=registration_failed");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}

?>
