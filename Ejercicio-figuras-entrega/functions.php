<?php
function classAutoLoader($class)
{
    $class = strtolower($class);
    $classFile = $_SERVER['DOCUMENT_ROOT'] . '/ejercicio-figuras-entrega/clases/' . $class . '.php';
    if (is_file($classFile) && !class_exists($class))
        include $classFile;
}

function hexadecimalARgb($hexadecimal)
{
    list($r, $g, $b) = sscanf($hexadecimal, "#%02x%02x%02x");
    return [$r, $g, $b];
} 

function showForm($fig)
{
    print ("<form class=\"config\" action=\"./showFigures.php\" method=\"POST\">");
    if ($fig === "sqr") {
        print ("<lable>Lado del Cuadrado: <input type=\"number\" name=\"side\" required></lable> ");
    }
    if ($fig === "trg") {
        print ("<lable>Base del Triángulo: <input type=\"number\" name=\"base\" required></lable> ");
        print ("<lable>Altura del Triángulo: <input type=\"number\" name=\"heigth\" required></lable> ");
        print ("<lable>Rectangulo: <input type=\"checkbox\" name=\"rectangulo\" ></lable> ");

    }
    if ($fig === "crl") {
        print ("<lable>Radio del Cículo: <input type=\"number\" name=\"radio\" required></lable> ");
    }

    print ("<br>
    <input type=\"submit\" name=\"Continuar\" value=\"Generar\">
    </form>");
}