<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once "./clases/book.php";
    include_once "./clases/customer.php";
    require_once "./utils.php";

    if(!isset($_SESSION["logedUser"])){
        header("location:./login.php");
    }
    print("
    <form action=\"#\" method=\"POST\">
        <input type=\"submit\" name=\"insertBook\" value=\"Insert book\" />
        </br>
        <input type=\"submit\" name=\"rentBook\" value=\"Rent book\" />
        </br> 
        <input type=\"submit\" name=\"buyBook\" value=\"Buy book\" />
        </br>
        <input type=\"submit\" name=\"returnBook\" value=\"Return book\" />
        </br>
        <input type=\"submit\" name=\"deleteBook\" value=\"Delete book\" />
        </br>
        <input type=\"submit\" name=\"seeBooks\" value=\"See my books\" />
        </br>
        <input type=\"submit\" name=\"logOut\" value=\"Log Out\" />
    </form>
    ");
    
    ?>
</body>
</html>