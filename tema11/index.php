<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Tema 11</h1>
<form action="" method="post">
filas: <input type="number" name="filas" />
columnas: <input type="number" name="columnas" />
<input type="submit" value="Submit">

</form>

<?php
include './funciones.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    if ($filas && $columnas) {
        generarTabla($filas, $columnas, '80%', '300px', '#f0f0f0', '#0000ff', '2px');
    } else {
        echo "Por favor, ingresa el número de filas y columnas.";
    }
}


?>
</body>
</html>