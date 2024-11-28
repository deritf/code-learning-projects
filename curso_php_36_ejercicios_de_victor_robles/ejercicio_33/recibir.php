<?php

//Esto significa: Si existe (si recibimos) algo por un formulario (es decir, por POST), usamos var_dump para ver su contenido.
if (isset($_POST["submit"])) {
    if (!empty($_POST["name"]) && strlen($_POST["name"])<=20 && !is_numeric($_POST["name"]) && !preg_match("/[0-9]/", $_POST["name"])) {
        echo "Nombre: " . htmlspecialchars($_POST["name"]) . "</br>";
    }
    if (!empty($_POST["surname"]) && strlen($_POST["surname"])<=20 && !is_numeric($_POST["surname"]) && !preg_match("/[0-9]/", $_POST["surname"])) {
        echo "Apellido: " . htmlspecialchars($_POST["surname"]) . "</br>";
    }
    if (!empty($_POST["bio"])) {
        echo "Biografía: " . nl2br(htmlspecialchars($_POST["bio"])) . "</br>";
    }
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "Correo Electrónico: " . htmlspecialchars($_POST["email"]) . "</br>";
    }
    if (!empty($_POST["password"]) && strlen($_POST["password"])>=6) {
        $hashedPassword = sha1($_POST["password"]); // Cifrado SHA-1
        echo "Contraseña (cifrada): " . htmlspecialchars($hashedPassword) . "</br>";
    }
    if (!empty($_POST["role"])) {
        echo "Rol: " . htmlspecialchars($_POST["role"]) . "</br>";
    }
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
        echo "La imagen nos ha llegado";
    }
}
?>