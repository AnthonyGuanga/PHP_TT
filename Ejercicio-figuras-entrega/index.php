<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();
    include "./functions.php";
    
    if (isset($_POST["continue"])) {
        $_SESSION["fig"]=$_POST["fig"];
        $_SESSION["color"] = $_POST["chosenColor"];
    } else {
        $_SESSION["fig"] = "sqr";
        $_SESSION["color"] = "#000000";
    }

    ?>
    <form class="config" action="#" method="POST">
    <label class="chosenColor">Color:
            <input type="color" name="chosenColor" value="<?php print ($_SESSION["color"]) ?>">
        </label>
        <br>
        <label class="figure">Figura:
            <input type="radio" name="fig" value="sqr" <?php $_SESSION["fig"] === "sqr" ? print ("checked") : "" ?>>Cuadrado</input>
            <input type="radio" name="fig" value="trg" <?php $_SESSION["fig"] === "trg" ? print ("checked") : "" ?>>Triangulo</input>
            <input type="radio" name="fig" value="crl" <?php $_SESSION["fig"] === "crl" ? print ("checked") : "" ?>>Circulo</input>
        </label>
        <br>
        
        <input class="continue" type="submit" name="continue" value="Continuar">
    </form>

    <?php
    //print($_POST["chosenColor"]);
    if (isset($_POST["continue"])) {
        showForm($_POST["fig"]);
    }
    ?>
    
</body>

</html>

