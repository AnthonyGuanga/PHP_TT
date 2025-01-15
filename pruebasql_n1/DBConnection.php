<?php
require_once "DBConnection.php";
$db = new DBConnection("config.json");
$connection = $db->dbConnect();

class DBConnection {

    public $dsn;
    public $user;
    public $password;
    public $connection;
    public $db;

    public function __construct($configFile) {
        $config = json_decode(file_get_contents($configFile), TRUE);
        $this->dsn = "{$config['DBType']}:dbname={$config['DBName']};host={$config['Host']}";
        $this->user = "{$config['User']}";
        $this->db = "{$config['DBType']}:host={$config['Host']}";
        $this->password = "{$config['Password']}";
    }

    function dbConnect() {
        try {
            $connection = new PDO($this->dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $connection;
        } catch (PDOException $error) {
            echo "<h2>No existe la base de datos, creándola</h2>";
            $connection = new PDO($this->db, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            
            // Crear la base de datos si no existe
            $query = $connection->prepare('CREATE DATABASE IF NOT EXISTS libros COLLATE utf8_spanish_ci');
            $query->execute();

            if ($query) {
                $use_db = $connection->prepare('USE libros');
                $use_db->execute();

                if ($use_db) {
                    // Crear tablas en el orden correcto
                    $tables = [
                        // Tabla customer
                        "CREATE TABLE IF NOT EXISTS customer (
                            id INT(10) NOT NULL AUTO_INCREMENT,
                            firstname VARCHAR(255) DEFAULT NULL,
                            surname VARCHAR(255) DEFAULT NULL,
                            email VARCHAR(255) DEFAULT NULL,
                            type ENUM('basic','premium') DEFAULT NULL,
                            PRIMARY KEY (id)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8",

                        // Tabla book
                        "CREATE TABLE IF NOT EXISTS book (
                            id INT(10) NOT NULL AUTO_INCREMENT,
                            isbn VARCHAR(13) DEFAULT NULL,
                            title VARCHAR(255) DEFAULT NULL,
                            author VARCHAR(255) DEFAULT NULL,
                            stock SMALLINT(5) DEFAULT NULL,
                            price FLOAT DEFAULT NULL,
                            PRIMARY KEY (id)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8",

                        // Tabla sale
                        "CREATE TABLE IF NOT EXISTS sale (
                            id INT(10) NOT NULL AUTO_INCREMENT,
                            customer_id INT(10) DEFAULT NULL,
                            date DATETIME DEFAULT NULL,
                            PRIMARY KEY (id),
                            FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8",

                        // Tabla sale_book
                        "CREATE TABLE IF NOT EXISTS sale_book (
                            book_id INT(10) NOT NULL,
                            sale_id INT(10) NOT NULL,
                            amount SMALLINT(5) DEFAULT NULL,
                            PRIMARY KEY (book_id, sale_id),
                            FOREIGN KEY (book_id) REFERENCES book(id) ON DELETE CASCADE,
                            FOREIGN KEY (sale_id) REFERENCES sale(id) ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8",

                        // Tabla borrowed_books
                        "CREATE TABLE IF NOT EXISTS borrowed_books (
                            book_id INT(10) NOT NULL,
                            customer_id INT(10) NOT NULL,
                            start DATETIME NOT NULL,
                            end DATETIME DEFAULT NULL,
                            PRIMARY KEY (book_id, customer_id, start),
                            FOREIGN KEY (book_id) REFERENCES book(id) ON DELETE CASCADE,
                            FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
                    ];

                    foreach ($tables as $tableQuery) {
                        $tableCreation = $connection->prepare($tableQuery);
                        $tableCreation->execute();
                    }
                }
            }
            return $connection;
        }
    }

    function dbClose() {
        $this->connection = null;
    }
}

?>
