<?php
    class Cuadrado extends Figuras{

        private $lado ;

        public function __construct($lado) {
            $this->lado = $lado;
        }


        public function __tostring(){
            return "Soy un cuadrado";
            }

            public function obtenerArea(){
                parent::obtenerArea();
            }
    }
?>