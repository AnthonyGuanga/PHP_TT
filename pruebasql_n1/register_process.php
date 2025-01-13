<?php
require_once 'DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $firstname = trim($_POST['firstname']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $type = trim($_POST['type']);

    // Validación básica
    if (empty($firstname) || empty($surname) || empty($email) || empty($password) || empty($type)) {
        header("Location: register.php?error=registration_failed");
        exit;
    }

    try {
        // Crear instancia de la conexión a la base de datos
        $dbConnection = new DBConnection('config.json');
        $connection = $dbConnection->dbConnect();

        // Verificar si el correo ya está registrado
        $checkEmailQuery = "SELECT id FROM customer WHERE email = :email";
        $stmt = $connection->prepare($checkEmailQuery);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: register.php?error=email_taken");
            exit;
        }

        // Insertar nuevo usuario
        $hashedPassword = md5($password); // Codificar la contraseña en MD5
        $insertQuery = "INSERT INTO customer (firstname, surname, email, type) VALUES (:firstname, :surname, :email, :type)";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: login.php?success=registered");
            exit;
        } else {
            header("Location: register.php?error=registration_failed");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: register.php");
    exit;
}
?>
