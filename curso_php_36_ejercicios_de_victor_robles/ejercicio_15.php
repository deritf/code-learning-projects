<h2>Ejercicio 15</h2>
<?php
echo '<hr>';

$matriz = array("hola", 2);
$verdadero = TRUE;
$texto = "Bienvenido";

if(is_array($matriz)==true){
    echo "Es un array"."</br>";
}

if(is_bool($verdadero)){
    echo "Es un booleano"."</br>";
}

if(is_string($texto)){
    echo "Es un string"."</br>";
}

?>