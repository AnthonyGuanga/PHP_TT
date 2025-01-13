
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['figuras'])){
    $figura = $_POST['figuras'];
    if($figura == 'Circulo'){
        echo <<< eot
        <h1>Circulo</h1>
        <form action="Circulo.php" method="GET">
        <input type="color" name="color" id="color">
            Ingresa el radio del circulo: <input name="radioCirculo" type="number"/>
            </br>
            <input type="submit"/>
        </form>
        eot;
    }
    if($figura == 'Cuadrado'){
        echo <<< eot

        cuadrado
        eot;
    }
    if($figura == 'Triangulo'){
        echo <<< eot
        triangulo

        eot;
    }
    if($figura == 'Rectangulo'){
        echo <<< eot
        rectangulo

        eot;
    }
   
}


echo <<< eot

eot;

?>

