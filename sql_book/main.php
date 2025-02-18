<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Main Page</title>
</head>

<body>
    <h1>Welcome to the Digital BookShop</h1>
    <?php
    include_once "./clases/book.php";
    include_once "./clases/customer.php";
    require_once "./utils.php";

    if (!isset($_SESSION["logedUser"])) {
        header("location:./login.php");
    }

    print ("<form action=\"#\" method=\"POST\" class=\"mainForm\" >
        
        <input type=\"submit\" name=\"insertBook\" value=\"Insert book\" />

        <input type=\"submit\" name=\"rentBook\" value=\"Rent book\" />

        <input type=\"submit\" name=\"buyBook\" value=\"Buy book\" />

        <input type=\"submit\" name=\"returnBook\" value=\"Return book\" />

        <input type=\"submit\" name=\"deleteBook\" value=\"Delete book\" />

        <input type=\"submit\" name=\"seeBooks\" value=\"See my books\" />

        <input type=\"submit\" name=\"logOut\" value=\"Log Out\" />

        </form><br><br>");



    if (isset($_POST["logOut"])) {
        $_SESSION=[];
        header("Refresh: .1");
    }

    if (isset($_POST["buyBook"])) {
        showAllBooks("buyBook");
        if (isset($_POST["chosenBook"])) {
            $chosenBook=Book::fromId($_POST["chosenBook"]);
            print("<br><p>You have chosen: ".$chosenBook->title."</p><br>");
            print("<p>By: ".$chosenBook->author."</p>");
            print("<p style=\"color: ".($chosenBook->stock<=0? "red":"")."\" >Stock: ".$chosenBook->stock."</p>");
            print("<p>Price: ".$chosenBook->price."</p>");
            print("<form action=\"#\" method=\"POST\">
            <input type=\"hidden\" name=\"buyBook\" value=\"\" />
            <input type=\"hidden\" name=\"bookId\" value=\"".$_POST["chosenBook"]."\" />
            <input type=\"submit\" name=\"confirmBuy\" value=\"Confirm\"  ".($chosenBook->stock<=0? "disabled":"")."  />
            </form>
            ");
        }
        if (isset($_POST["confirmBuy"])) {
            $customer= Customer::fromId($_SESSION["logedUser"]["id"]);
            $chosenBook=Book::fromId($_POST["bookId"]);

            //var_dump($customer);
            $message=$customer->buyBook($_POST["bookId"],$chosenBook->price);
            print("<p>".$message."</p>");
        }
    }


    //To access debug mode copypaste:  <input type=\"submit\" name=\"debug\" value=\"debug mode\" />
    if (isset($_POST["debug"])) {
        print("Welcome to debug mode, this is only for the developers to try new things!");
    }

    if (isset($_POST["seeBooks"])) {
        $customer=Customer::fromId($_SESSION["logedUser"]["id"]);
        $rentedBooks= $customer->getRentedBooks();
        if (sizeof($rentedBooks)===0) {
            print("You don't have any books");
            
        }
        else {
            print("<div class=\"bookContainer\">");
            print("<div class=\"rentedBooks\"><h1>Rented Books</h1>");
            foreach ($rentedBooks as $bookId) {
                $book=Book::fromId($bookId["book_id"]);
                print("
                <div style=\"border: 1px solid black; width: fit-content; padding:5px\">
                    <p>Title: ".$book->title."</p>
                    <p>Author: ".$book->author."</p>
                </div>
                <br><br>
                ");
            }
            print("</div>");



            
            print("</div>");

        }
        
    }

    if (isset($_POST["deleteBook"])) {
        showAllBooks("deleteBook");
        if (isset($_POST["chosenBook"])) {
            $chosenBook=Book::fromId($_POST["chosenBook"]);
            print("<br><p>You have chosen: ".$chosenBook->title."</p><br>");
            print("<form action=\"#\" method=\"POST\">
            <input type=\"hidden\" name=\"deleteBook\" value=\"Rent book\" />
            <input type=\"hidden\" name=\"bookId\" value=\"".$_POST["chosenBook"]."\" />
            <input type=\"submit\" name=\"confirmDelete\" value=\"Confirm\"    />
            </form>
            ");
        }
        if (isset($_POST["confirmDelete"])) {
            $chosenBook=Book::fromId($_POST["bookId"]);
            $success=$chosenBook->deleteBook();
            if ($success) {
                //header("Refresh: 1");
                print("<p style=\"color:red;\" >Book deleted</p>");
            }
            else {
                print("<p style=\"color:red;\" >Error, try again later</p>");
            }
            
        }
    }

    if (isset($_POST["returnBook"])) {
        $customer=Customer::fromId($_SESSION["logedUser"]["id"]);
        $rentedBooks= $customer->getRentedBooks();
        if (sizeof($rentedBooks)===0) {
            print("You don't have books rented");
            
        }
        else {
            print("<form action=\"#\" method=\"POST\">");
            foreach ($rentedBooks as $bookId) {
                //var_dump($book);
                $book=Book::fromId($bookId["book_id"]);
                print($book->title."
                <lable>
                <input type=\"submit\" name=\"chosenBook\" value=\"".$bookId["book_id"]."\" />
                </lable>
                ");
                print("<br><br>");
            }
            print("
            <input type=\"hidden\" name=\"returnBook\"/>
            </form>");
            if (isset($_POST["chosenBook"])) {
                $chosenBook=Book::fromId($_POST["chosenBook"]);

                print("<p>You have chosen: ".$chosenBook->title."</p>");
                print("<form action=\"#\" method=\"POST\">
                <input type=\"hidden\" name=\"returnBook\" />
                <input type=\"hidden\" name=\"bookId\" value=\"".$_POST["chosenBook"]."\" />
                <input type=\"submit\" name=\"confirmReturn\" value=\"Confirm\"/>
                </form>
                ");
            }
            if (isset($_POST["confirmReturn"])) {
                $customer = Customer::fromId($_SESSION["logedUser"]["id"]);

                $message=$customer->returnBook($_POST["bookId"]);
                print($message);
                header("Refresh: 1");
            }
        }

    }

    if (isset($_POST["rentBook"])) {
        showAllBooks("rentBook");
        if (isset($_POST["chosenBook"])) {
            //var_dump($_POST["chosenBook"]);
            $chosenBook=Book::fromId($_POST["chosenBook"]);

            $customer=getCustomer($_SESSION["logedUser"]["id"]);
            print("Usuario: ".$customer["firstname"]);

            print("<br><p>You have chosen: ".$chosenBook->title."</p><br>");
            print("<p>By: ".$chosenBook->author."</p>");
            print("<p style=\"color: ".($chosenBook->stock<=0? "red":"")."\" >Stock: ".$chosenBook->stock."</p>");
            print("<form action=\"#\" method=\"POST\">
            <input type=\"hidden\" name=\"rentBook\" value=\"Rent book\" />
            <input type=\"hidden\" name=\"bookId\" value=\"".$_POST["chosenBook"]."\" />
            <input type=\"submit\" name=\"confirmRent\" value=\"Confirm\"  ".($chosenBook->stock<=0? "disabled":"")."  />
            </form>
            ");
        }
        if (isset($_POST["confirmRent"])) {
            $chosenBook=Book::fromId($_POST["bookId"]);
            $message=$chosenBook->rentBook($_SESSION["logedUser"]["id"]);
            //var_dump($customer);
            print($message);
            //var_dump($_SESSION);
            //var_dump($chosenBook);
        }
    }

    if (isset($_POST["insertBook"])) {
        print ("<form action=\"#\" method=\"POST\">
        <lable>
            ISBN:
            <input type=\"text\" name=\"isbn\" placeholder=\"xxx-x-xx-xxxx\" pattern=\"[0-9]{3}-[0-9]-[0-9]{2}-[0-9]{4}\" required ></input>
        </lable>
        <lable>
            Title:
            <input type=\"text\" name=\"title\" placeholder=\"...\" required ></input>
        </lable>
        <lable>
            Author:
            <input type=\"text\" name=\"author\" placeholder=\"...\" required ></input>
        </lable>
        <lable>
            Stock:
            <input type=\"number\" name=\"stock\" placeholder=\"...\" required ></input>
        </lable>
        <lable>
            Price:
            <input type=\"number\" name=\"price\" placeholder=\"...\" required ></input>
        </lable>

        <input type=\"hidden\" name=\"insertBook\" value=\"\" />
        <input type=\"submit\" name=\"newBook\" value=\"Insert book\" />

        </form><br><br>");
        if (isset($_POST["newBook"])) {
            $newBook= new Book($_POST["isbn"],$_POST["title"],$_POST["author"],$_POST["stock"],$_POST["price"]);
            $message=$newBook->addBook();
            print("<p>".$message."</p>");
        }
    }

    ?>

</body>

</html>