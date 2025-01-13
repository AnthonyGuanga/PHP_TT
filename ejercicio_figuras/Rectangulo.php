<?php
    class Rectangulo extends Figuras{

        private $altura;
        private $base;

        public function __construct($altura,$base) {
            $this->altura = $altura;
            $this->base = $base;
        }
        public function __tostring(){
            return "Soy un rectangulo";
            }
        
            public function obtenerArea(){

                $area = $this->altura * $this->base;

                echo "La area del Rectangulo.'$area'.";
                parent::obtenerArea();
            }
    }

?>