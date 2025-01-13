<?php
class Triangulo extends Figuras{

    private $lado;
    private $altura;
    public function __construct($lado,$altura) {
        $this->lado = $lado;
        $this->altura = $altura;
    }
    public function __tostring(){
        return "Soy un triangulo";
        }

        public function obtenerArea(){
            parent::obtenerArea();
        }
}

?>