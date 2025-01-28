<?php

class DBConnetion {

  public $dsn;
  public $user;
  public $password;
  public $connection;
  public $db;

  public function __construct($configFile) {
    $config = json_decode(file_get_contents($configFile), TRUE);
    $this->dsn = "{$config['DBType']}:dbname={$config['DBName']};host={$config['Host']}";;
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
        $query = $connection->prepare('CREATE DATABASE IF NOT EXISTS bbdd COLLATE utf8_spanish_ci');
        $query->execute();

        if($query){
      		$use_db = $connection->prepare('USE bbdd');
      		$use_db->execute();
        }
				if($use_db){
          //Crear tablas
		   }
       return $connection;

      }
    }

    function dbClose() {
       $connection = null;
    }

}

?>
