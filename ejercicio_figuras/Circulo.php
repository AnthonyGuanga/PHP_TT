<?php
class Circulo {
    private $ancho;
    private $alto;
    private $colorHex;

    public function __construct($ancho, $alto, $colorHex) {
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->colorHex = $colorHex;
    }

    private function hexToRGB($hex) {
        // Convierte el color hexadecimal a componentes RGB
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return [$r, $g, $b];
    }

    public function generarImagen() {
        // Crear una imagen en blanco
        $imagen = imagecreatetruecolor($this->ancho, $this->alto);

        // Asignar colores
        $blanco = imagecolorallocate($imagen, 255, 255, 255);
        list($r, $g, $b) = $this->hexToRGB($this->colorHex);
        $colorCírculo = imagecolorallocate($imagen, $r, $g, $b);

        // Rellenar el fondo con blanco
        imagefill($imagen, 0, 0, $blanco);

        // Dibujar el círculo
        imagefilledellipse($imagen, $this->ancho / 2, $this->alto / 2, 200, 200, $colorCírculo);

        // Enviar la imagen generada al navegador
        header('Content-Type: image/png');
        imagepng($imagen);

        // Liberar memoria
        imagedestroy($imagen);
    }
}

// Manejo de la solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['color'])) {
    $colorHex = $_GET['color'];

    // Validar el color hexadecimal
    if (preg_match('/^#([a-fA-F0-9]{6})$/', $colorHex)) {
        $circulo = new Circulo(300, 300, $colorHex);
        $circulo->generarImagen();
    } else {
        echo "Color inválido.";
    }
} else {
    echo "Por favor, selecciona un color.";
}
?>
