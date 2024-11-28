<h2>Ejercicio 17</h2>
<?php
echo '<hr>';

function factorial($numero){
    $resultado = 1;
    for ($x=$numero; $x > 0; $x--){
        $resultado *= $x;
    }

    return $resultado;
}

$dato = 5;
echo "El factorial de ".$dato." es ".factorial($dato);
?>