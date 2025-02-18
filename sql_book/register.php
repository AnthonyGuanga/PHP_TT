<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>welcome to the registry</h1>
    <a href="./index"><button>Go back to login</button></a>
    <?php
    
    print("<form action=\"./validateRegister.php\ method=\"POST\">
    <br/>
    <label>
        Firsname :
        <input type=\"text\" name=\"firsname\" placeholder=\"Your name\"/>
    </label>
    <br/>
    <label>
        Surname :
        <input type=\"text\" name=\"surname\" placeholder=\"Your surname\"/>
    </label>
    <br/>
<label>
        Email :
        <input type=\"text\" name=\"email\" placeholder=\"example@email.com\"/>
    </label>
    <br/>
    <label>
        Password :
        <input type=\"text\" name=\"password\" placeholder=\"your password\"/>
    </label>
     <br/>
    <label>
        <input type=\"radio\" name=\"type\" value=\"basic\" checked> Basic </input>
        <input type=\"radio\" name=\"type\" value=\"premiun\" > Premiun </input>
    </label>
    </br>
    <input type=\"submit\" name=\"register\" value=\"confirm\"/>
    </form>");
    ?>
</body>
</html>