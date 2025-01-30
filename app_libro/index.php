<?php
session_start();

if (!isset($_SESSION["logedUser"])) {
    header("location:./indexLogin.php");
}
else {
    header("location:mainpage.php");
}

