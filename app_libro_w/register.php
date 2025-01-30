<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register!</title>
</head>
<body>
    <h1>Your user was not in our database</h1>
    <h2>Register now!</h2>
    <a href="./indexLogin" ><button>Go back to login</button></a>
    <?php
    print ("
    <br/>
    <br/>
    <form action=\"./validateRegister.php\" method=\"POST\">
    <label>
        Firstname:
        <input type=\"text\" minlength=\"1\" name=\"firstName\" required placeholder=\"Your name...\" />
    </label>
    <br/>
    <br/>
    <label>
        Surname:
        <input type=\"text\" minlength=\"1\" name=\"surname\" required placeholder=\"Your surname...\" />
    </label>
    <br/>
    <br/>
    <label>
        Email (this will be your username):
        <input type=\"email\" minlength=\"1\" name=\"userName\" required placeholder=\"Example@gmail.com\" />
    </label>
    <br/>
    <br/>
    <label>
        Password:
        <input type=\"password\" minlength=\"1\" name=\"password\" required placeholder=\"Your password\" />
    </label>
    <br/>
    <br/>
    <label>
        Type:
        <input type=\"radio\" name=\"customerType\" value=\"premium\" checked> Premium </input>
        <input type=\"radio\" name=\"customerType\" value=\"basic\"> Basic </input>
    </label>
    <br/>
    <br/>
    
    <input type=\"submit\" name=\"register\" value=\"Confirm\" />
    </form>");



    ?>
</body>
</html>