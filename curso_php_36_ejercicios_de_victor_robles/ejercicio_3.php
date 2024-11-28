<h2>Ejercicio 3</h2>
<?php
echo '<hr>';

for ($i = 1; $i<=30; $i++){
    if ($i % 2 == 0 ) {
        echo $i." su cuadrado es: ".($i*$i)." PAR.";
    } else {
        echo $i." su cuadrado es: ".($i*$i)." IMPAR.";
    }
    echo "<br>";
}
?>