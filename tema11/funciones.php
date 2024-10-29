<?php 
function generarTabla($filas, $columnas, $ancho = '100%', $alto = 'auto', $colorFondo = '#ffffff', $colorBorde = '#000000', $grosorBorde = '1px') {
    echo "<table style='width: $ancho; height: $alto; border-collapse: collapse; background-color: $colorFondo; border: $grosorBorde solid $colorBorde;'>";
    
    for ($i = 0; $i < $filas; $i++) {
        echo "<tr>";
        
        for ($j = 0; $j < $columnas; $j++) {
            echo "<td style='border: $grosorBorde solid $colorBorde; padding: 10px;'>Celda ($i, $j)</td>";
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
}
?>