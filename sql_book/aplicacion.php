<?php
require_once "DBConnection.php";
require_once "customer.php";

$db = new DBConnection();
$conexion = $db->getConnection();
if ($conexion) {
    try{
        $sql = "SELECT * FROM book";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($resultados);
        
        foreach($resultados as $book){
            echo "Titulo: ".$book['title']."<br>";
            echo "Autor: ".$book['author']."<br>";
            echo "Precio: ".$book['price']."<br>";
            echo "Stock: ".$book['stock']."<br>";
            echo "<hr>";
        }
    }catch(PDOException $e){
        echo "Error en la consulta";
    }
} else {
    echo "Error en la conexión";
}
// adriancadillo
// proyectosistemas

