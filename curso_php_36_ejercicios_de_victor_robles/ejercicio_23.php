<h2>Ejercicio 23</h2>
<?php
echo '<hr>';

session_start();

if(!isset($_SESSION["numero"])){
    $_SESSION["numero"]=0;
}

if(isset ($_GET["counter"]) && $_GET["counter"] == 1){
    $_SESSION["numero"]++;
} elseif (isset ($_GET["counter"]) && $_GET["counter"] == 0) {
    $_SESSION["numero"]--;
}

echo "Sesión número: ".$_SESSION["numero"];

?>