<?php
class MiCabecera{
    public $title;
    public $color;

    public function __construct($title,$color){
        $this->title=$title;
        $this->color=$color;
    }

    public function paintHeader(){
        print("<header style=\" background-color:".$this->color."; text-align:center; padding:3%\">
        <h1 style=\"margin:0\">"
        .$this->title.
        "</h1>
        <h3>
        By Guillermo León Gordo
        </h3>
        <p>IES Maria de Zayas y Sotomayor</p>
        </header");
    }
}