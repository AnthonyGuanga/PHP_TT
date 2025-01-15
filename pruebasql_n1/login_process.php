<?php
session_start();
require_once "DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Por favor, completa todos los campos.";
        header("Location: login.php");
        exit();
    }

    try {
        // Conexión a la base de datos
        $db = new DBConnection("config.json");
        $connection = $db->dbConnect();

        // Verificar si el usuario existe
        $query = $connection->prepare("SELECT * FROM customer WHERE email = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Validar contraseña
            if (password_verify($password, $user['password'])) {
                // Guardar los datos del usuario en la sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['firstname'] . " " . $user['surname'];
                $_SESSION['user_type'] = $user['type'];

                // Redirigir según el tipo de usuario
                if ($user['type'] === 'premium') {
                    header("Location: index_premium.php");
                } else {
                    header("Location: index_basic.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "No se encontró un usuario con ese correo electrónico.";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error de conexión: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
