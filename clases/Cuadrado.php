<?php

class Cuadrado extends Figura
{

    private $side;
    function __construct($side, $color)
    {
        $this->color = $color;
        $this->vertex = 4;
        $this->side = $side;

    }
    function draw()
    {
        $img = imagecreatetruecolor($this->side, $this->side);
        $color = imagecolorallocate($img, $this->color[0], $this->color[1], $this->color[2]);
        imagefill($img, 0, 0, $color);

        ob_start();
        imagejpeg($img);
        $temp = ob_get_clean();
        imagedestroy($img);

        //print ("<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />");
        return "<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />";

    }
    function __tostring()
    {
        return ("<div style=\"text-align:center; width: fit-content;\">
        " . $this->draw() . "
        <br>
        " . $this->getMessage() . "
        </div>");
    }
    
    function __get($name){
        return $this->$name;
    }
    function __set($name, $value){
        $this->$name=$value;
    }
    function getMessage()
    {
        return "Soy un Cuadrado de lado: " . $this->side;
    }
    
    

}

