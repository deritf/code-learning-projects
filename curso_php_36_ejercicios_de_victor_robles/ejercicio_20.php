<h2>Ejercicio 20</h2>
<?php
echo '<hr>';

$email = $_GET["email"];

function validateEmail($email){
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $status = "VALIDO";
    } else {
        $status = "NO VALIDO";
    }
    return $status;
}

$email = "";

if(isset($_GET["email"])){
    $email = $_GET["email"];
}

$_GET["email"];

echo validateEmail($email);

?>