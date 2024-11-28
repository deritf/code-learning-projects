<h2>Ejercicio 8</h2>
<?php
echo '<hr>';


if(isset($_GET["numero"]) && is_numeric($_GET["numero"])){
    $numero = $_GET["numero"];
} else {
    $numero = 5; //numero por defecto
    echo "Número por defecto... . Añade a la URL: ?numero=X ,dónde X es el número que tu quieres.";
}

echo "<h2>Factorial del ".$numero."!"."</h2>";

$factorial = 1;
$numero = $_GET["numero"];

for($cont = 1; $cont <= $numero; $cont++){
    $factorial *= $cont;
}
echo $factorial;
?>