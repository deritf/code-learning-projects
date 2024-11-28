<h2>Ejercicio 6</h2>
<?php
echo '<hr>';

$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", "Octubre", "Noviembre", "Diciembre", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", "Octubre", "Noviembre", "Diciembre");

for ($i=0; $i<count($meses); $i++){
    echo "El mes ".($i+1)." es ".$meses[$i];
    echo '<br>';
}
?>