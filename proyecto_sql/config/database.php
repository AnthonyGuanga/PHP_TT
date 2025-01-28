<?php
// config/database.php
require_once 'DBConnetion.php'; // Asegúrate de que la ruta sea correcta

class Database {
    private $connection;

    public function __construct() {
        $dbConnection = new DBConnetion('config/db_config.json'); // Ruta al archivo de configuración
        $this->connection = $dbConnection->dbConnect();
    }

    public function getConnection() {
        return $this->connection;
    }
    
}
// if ($use_db) {
//     // Crear tabla de clientes
//     $query = $connection->prepare('
//         CREATE TABLE IF NOT EXISTS customers (
//             id INT AUTO_INCREMENT PRIMARY KEY,
//             name VARCHAR(100) NOT NULL,
//             email VARCHAR(100) NOT NULL UNIQUE,
//             password VARCHAR(32) NOT NULL,
//             type ENUM("Basic", "Premium") DEFAULT "Basic"
//         )
//     ');
//     $query->execute();

//     // Crear tabla de libros
//     $query = $connection->prepare('
//         CREATE TABLE IF NOT EXISTS books (
//             id INT AUTO_INCREMENT PRIMARY KEY,
//             title VARCHAR(100) NOT NULL,
//             author VARCHAR(100) NOT NULL,
//             price DECIMAL(10, 2) NOT NULL
//         )
//     ');
//     $query->execute();
// }
?>