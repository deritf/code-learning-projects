<h2>Ejercicio 10</h2>
<?php
echo '<hr>';

if(isset($_GET["numero"]) && is_numeric($_GET["numero"])){
    $numero = $_GET["numero"];
} else {
    $_GET["numero"] = 5; //numero por defecto
    echo "Número por defecto... . Añade a la URL: ?numero=X ,dónde X es el número que tu quieres.";
}

$numero = 100;

for ($i=1; ($i<=$numero); $i++){

    if(isset($_GET["numero"]) && $i%$_GET["numero"] == 0){
        echo $i." es multiplo de ".$_GET["numero"]."<br>";
    }
}

?>