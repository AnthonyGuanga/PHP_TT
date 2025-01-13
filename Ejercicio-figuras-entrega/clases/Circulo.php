<?php
class Circulo extends Figura{
    private $radio;
    function __construct($radio,$color){
        $this->radio=$radio;
        $this->color=$color;
    }
    function __tostring(){
        return ("<div style=\"text-align:center; width: fit-content;\">
        " . $this->draw() . "
        <br>
        " . $this->getMessage() . "
        </div>");
    }
    function draw(){
        $img=imagecreatetruecolor($this->radio,$this->radio);
        $bg=imagecolorallocate($img,255,255,255);
        imagefill($img,0,0,$bg);
        $color = imagecolorallocate($img, $this->color[0], $this->color[1], $this->color[2]);
        imagefilledarc($img,$this->radio/2,$this->radio/2,$this->radio,$this->radio,0,360,$color,IMG_ARC_PIE);

        ob_start();
        imagejpeg($img);
        $temp = ob_get_clean();
        imagedestroy($img);

        //print ("<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />");
        return "<img src=\"data:image/jpeg;base64," . base64_encode($temp) . "\" />";

    }
    function getMessage(){
        return "Soy un ".__CLASS__." de radio: ".$this->radio;
    }
}