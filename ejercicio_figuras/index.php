<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Figuras</title>
</head>
<body>
    <h1>Figuras</h1>
    <h2>Selecciona la figura que desea </h2>
    <?php
    /*
    Dimenciones 
    el color
    color
    lado 

    
    */
        echo <<< eot
            <form action="form.php" method="post">
                <select name="figuras">
                    <option name="circulo">Circulo</option>
                    <option name="cuadrado">Cuadrado</option>
                    <option name="triangulo">Triangulo</option>
                    <option name="rectangulo">Rectangulo</option>
                </select>
                </br>
                
                </br>
                <button type="submit" name"enviar">ENVIAR</button>
            </form>
        eot;
 
    ?>
</body>
</html>

