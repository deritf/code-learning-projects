<h2>Ejercicio 5</h2>
<?php
echo '<hr>';


if(isset($_GET["numero"]) && is_numeric($_GET["numero"])){
    $numero = $_GET["numero"];
} else {
    $numero = 5; //numero por defecto
    echo "Número por defecto...";
}

echo "<h2>Tabla de multiplicar del ".$numero."</h2>";

for ($i=1; $i<=10; $i++) {
    echo $i." x ".$numero." = ".($i*$numero)."<br>";
}
?>