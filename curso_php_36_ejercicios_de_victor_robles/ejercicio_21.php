<h2>Ejercicio 21</h2>
<?php

function tabla($numero){
    $tabla = "";
    for ($i=1;$i<10;$i++){
        $cuenta = $i*$numero;
        $tabla .= "{$i} x {$numero} = {$cuenta}"."</br>";
    }

    return $tabla;
}

echo '<hr>';
$num = 9;
echo tabla($num);
echo '<hr>';

for ($i=1;$i<10;$i++){
    echo "<h3>Tabla del ".$i."</h3>";
    echo tabla($i)."</br>";
}

?>