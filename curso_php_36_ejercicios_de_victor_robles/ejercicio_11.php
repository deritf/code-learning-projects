<h2>Ejercicio 11</h2>
<?php
echo '<hr>';

$numeros = array(30, 20, 40, 50, 10);

echo "<h2>Recorrer el array</h2>";
foreach ($numeros as $numero){
        echo $numero."</br>";
}

sort($numeros);
echo "<h2>Ordenar de forma ascendente y recorrer el array</h2>";
foreach ($numeros as $numero){
        echo $numero."</br>";
}

rsort($numeros);
echo "<h2>Ordenar de forma descendente y recorrer el array</h2>";
foreach ($numeros as $numero){
        echo $numero."</br>";
}

echo "<h2>Longitud del array: ".count($numeros)."</h2>";
echo "<h2>Longitud del array: ".sizeof($numeros)."</h2>";

echo "<h2>Buscando un número en el array</h2>";
if(!array_search(10, $numeros)){
    echo "<p>El número no existe en el array</p>";
} else {
    echo "<p>El número si existe en el array</p>";
}

?>