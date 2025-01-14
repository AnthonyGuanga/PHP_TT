<?php

use Framework\Router;

// spl_autoload_register(function(string $class){

//     $path = 'src/'. str_replace('\\','/',$class.'.php');


//     require $path;
// });

require 'vendor/autoload.php';
$user =  new App\User;
echo $user->getName();

$productos = new Database\Models\Productmodel;
echo $productos->getId();

$router = new Router;
echo get_class($router);

$order = new \Database\Models\OrderModel;
echo get_class($order);