<?php
abstract class Figura{
    protected $color;
    protected $vertex;

    abstract  function draw();
    abstract function getMessage();
    function __tostring(){
        return "Soy una ".__CLASS__;
    }
}