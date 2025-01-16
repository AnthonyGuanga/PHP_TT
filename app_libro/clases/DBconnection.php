<?php
//namespace nombre;

/* recordar incluirlo en el index.php require '../vendor/autoload.php';*/

use \PDO;
use \PDOException;

class DBconnection {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected $connect;

    public function __construct() {
        $config = json_decode(file_get_contents(__DIR__.'\..\databaseConfig.json'), true);
        $this->host = $config['host'];
        $this->db = $config['dbname'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        $this->connect = DBconnection::crearConect($config);
    }

    public function getConnect() {
        return $this->connect;
    }

    private function crearConect($config) {
        try {
            //echo "<p>Estableciendo conexión con la base de datos...</p>";

            $connect = new PDO('mysql:dbname=' . $this->db . ';host=' . $this->host, $this->user, $this->pass);
            //echo "<p>Conexión con la base de datos exitosa</p>";
        }catch (PDOException $Exception) {
            if ($Exception->getCode() == 1049) {
              print ("La base de datos no existía, creando base de datos...<br>");
              print ($Exception->getMessage() . " --------- " . $Exception->getCode() . "<br>");
              $connect = new PDO('mysql:host=' . $this->host, $this->user, $this->pass);
              $sql = ("CREATE DATABASE " . $this->db);
              try {
                $connect->query($sql);
                print ("Base de datos creada correctamente<br>");
                $connect = new PDO('mysql:dbname=' . $this->db . ';host=' . $this->host, $this->user, $this->pass);
                print ("Conexión a la nueva base de datos exitosa<br>");
              } catch (PDOException $Exception2) {
                print ("Error al crear la base de datos<br>");
                throw new Exception($Exception->getMessage(), $Exception->getCode());
              }
            } else {
              print ("Error con la base de datos:<br>");
              print ($Exception->getMessage() . " --------- " . $Exception->getCode() . "<br>");
              throw new Exception($Exception->getMessage(), $Exception->getCode());
            }
          }
        
       /* $tableExists = $connect->query("SELECT * FROM table"); // Comprobar si existen las tablas pero no es necesario
        if (!$tableExists) { 
            $sqlFile = file_get_contents("../sql/{$this->db}.sql");
            $stm = $connect->prepare($sqlFile);
            $stm->execute();
        }*/
        return $connect;
    }
}
?>