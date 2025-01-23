<?php

class DBConnection {
  private $host = "localhost";
  private $db_name = "libro";
  private $username = "root";
  private $password = "";
  private $conn;

  // Método para obtener la conexión
  public function getConnection() {
      $this->conn = null;

      try {
          $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      } catch (PDOException $exception) {
          echo "Error de conexión: " . $exception->getMessage();
      }

      return $this->conn;
  }
  public function createTablas(){
    if($this->conn){
      $tables = [
        "book"=>"
        CREATE TABLE IF NOT EXISTS `book` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `isbn` varchar(13) DEFAULT NULL,
        `title` varchar(255) DEFAULT NULL,
        `author` varchar(255) DEFAULT NULL,
        `stock` smallint(5) DEFAULT NULL,
        `price` float DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;
        ",
        "borrowed_books"=>"
        CREATE TABLE IF NOT EXISTS `borrowed_books` (
        `book_id` int(10) NOT NULL,
        `customer_id` int(10) NOT NULL,
        `start` datetime NOT NULL,
        `end` datetime DEFAULT NULL,
        PRIMARY KEY (`book_id`,`customer_id`,`start`),
        KEY `customer_id` (`customer_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ",
        "customer"=>"
        CREATE TABLE IF NOT EXISTS `customer` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `firstname` varchar(255) DEFAULT NULL,
        `surname` varchar(255) DEFAULT NULL,
        `email` varchar(255) DEFAULT NULL,
        `password` varchar(255) DEFAULT NULL,
        `type` enum('basic','premium') DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ",
        "sale"=>"
          CREATE TABLE IF NOT EXISTS `sale` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `customer_id` int(10) DEFAULT NULL,
          `date` datetime DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `customer_id` (`customer_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ",
        "sale_book"=>"
        CREATE TABLE IF NOT EXISTS `sale_book` (
        `book_id` int(10) NOT NULL,
        `sale_id` int(10) NOT NULL,
        `amount` smallint(5) DEFAULT NULL,
        PRIMARY KEY (`book_id`,`sale_id`),
        KEY `sale_id` (`sale_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        "
      ];
      foreach($tables as $tableName => $sql){
        try{
          $this->conn->exec($sql);
          echo "Tabla'$tableName' creando o ya existe.<br>";
        }catch(PDOException $exception){
          echo "Error al crear la tabla'$tableName':".$exception->getMessage()."<br>";
        }
      }
      }else{
        echo "No hay conexion a la base de datos";
    }
  }

   public function insertData($tableName, $data){
    if($this->conn){
      try{
        $colums = implode(", ",array_keys($data));
        $placeholders = ":".implode(", :",array_keys($data));

        $sql = "INSERT INTO $tableName ($colums) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute($data);
        echo "Datos insertado '$tableName'.<br>";
      }catch(PDOException $exception){
        echo "No hay conexion a la base de datos.<br>";
      }
    }
   }

}
?>
