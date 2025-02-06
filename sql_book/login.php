<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Welcome</h1>
    </header>
    <?php
    require "../clases/Customer.php";
    require "./utils.php";
    if(!isset($_POST["custTypeSubmit"])){
        print("<h2>Are you a premium or basic customer?</h2>");
        print ("<form action=\"#\" method=\"POST\">
        <label>
            <input type=\"radio\" name=\"customerType\" value=\"premium\" checked> Premium </input>
            <input type=\"radio\" name=\"customerType\" value=\"basic\"> Basic </input>
        </label>
        <input type=\"submit\" name=\"custTypeSubmit\" value=\"Confirm\" />
        </form>");
    }else{
        $type = $_POST["customerType"];
        print("Login for " . $type . " customer: ");
        print ("<form action=\"#\" method=\"POST\">
        <label>Username:
            <input type=\"text\" name=\"userName\" required />
        </label>
        <br/>
        <label>Password:
            <input type=\"password\" name=\"password\" required />
        </label>
        <br/>
        <input type=\"hidden\" name=\"customerType\" value=\"" . $type . "\" />
        <input type=\"hidden\" name=\"custTypeSubmit\" value=\"kk\" />
        <input type=\"submit\" name=\"loginAttempt\" value=\"Confirm\" />
        </form>");
        if (isset($_POST["loginAttempt"])) {
            checkCustomer($_POST["userName"], $_POST["password"]);
        }
    }
    ?>
</body>
</html>