<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo <<<eot
        <form action="#" method="post">
            <label >Nombre:</label>
            <br/>
            <input type="text" name="nombre">
            <br/>
            <label >Apellido:</label>
            <br/>
            <input type="text" type="apellido">
             <br/>
            <label >Dni</label>
            <br/>
            <input type="text" type="dni">
            <br/>
            <button type="submit">Enviar</button>

        </form>

        eot;
    ?>
</body>
</html>