<?php
class Triangulo extends Figura
{
    
    private $heith;
    private $base;
    function __construct($base, $altura, $color)
    {
        $this->base = $base;
        $this->heith = $altura;
        $this->color = $color;
        $this->vertex = [0, $altura, $base, $altura, $base / 2, 0];

    }
    function draw()
    {
        $img = imagecreatetruecolor($this->base, $this->heith);
        $bg=imagecolorallocate($img,255,255,255);
        imagefill($img,0,0,$bg);
        $color = imagecolorallocate($img, $this->color[0], $this->color[1], $this->color[2]);
        imagefilledpolygon($img, $this->vertex,  $color);

        ob_start();
        imagejpeg($img);
        $temp = ob_get_clean();
        imagedestroy($img);
        
        //print ("<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />");
        return "<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />";

    }
    function __tostring(){
        return ("<div style=\"text-align:center; width: fit-content;\">
        " . $this->draw() . "
        <br>
        " . $this->getMessage() . "
        </div>");
    }
    function __get($name){
        return $this->$name;
    }
    function getMessage()
    {
        return "Soy un tríángulo de base: " . $this->base . " y altura: " . $this->heith;

    }

    function __set($name, $value){
        $this->$name=$value;
    }

}