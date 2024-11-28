<h2>Ejercicio 12</h2>
<?php
echo '<hr>';

$ip = $_SERVER["REMOTE_ADDR"];
$browser = $_SERVER["HTTP_USER_AGENT"];

echo "Tu IP es: ".$ip."</br>";
echo "Tu navegador es: ".$browser;

if (strpos($browser, "Edg") !== false) {
    echo "<h1>El navegador que usas es Microsoft Edge.</h1>";
} elseif (strpos($browser, "Chrome") !== false && strpos($browser, "Edg") === false) {
    echo "<h1>El navegador que usas es Google Chrome.</h1>";
} elseif (strpos($browser, "Safari") !== false && strpos($browser, "Chrome") === false && strpos($browser, "Edg") === false) {
    echo "<h1>El navegador que usas es Safari.</h1>";
} elseif (strpos($browser, "Firefox") !== false) {
    echo "<h1>El navegador que usas es Firefox ¡¡¡ENHORABUENA!!!</h1>";
} elseif (strpos($browser, "Opera") !== false || strpos($browser, "OPR") !== false) {
    echo "<h1>El navegador que usas es Opera.</h1>";
} else {
    echo "<h1>No se pudo identificar tu navegador.</h1>";
}

?>