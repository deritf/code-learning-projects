<?php

//Esto significa: Si existe (si recibimos) algo por un formulario (es decir, por POST), usamos var_dump para ver su contenido.
if (isset($_POST["submit"])) {
    if (!empty($_POST["name"])) {
        echo "Nombre: " . htmlspecialchars($_POST["name"]) . "</br>";
    }
    if (!empty($_POST["surname"])) {
        echo "Apellido: " . htmlspecialchars($_POST["surname"]) . "</br>";
    }
    if (!empty($_POST["bio"])) {
        echo "Biografía: " . nl2br(htmlspecialchars($_POST["bio"])) . "</br>";
    }
    if (!empty($_POST["email"])) {
        echo "Correo Electrónico: " . htmlspecialchars($_POST["email"]) . "</br>";
    }
    if (!empty($_POST["password"])) {
        $hashedPassword = sha1($_POST["password"]); // Cifrado SHA-1
        echo "Contraseña (cifrada): " . htmlspecialchars($hashedPassword) . "</br>";
    }
    if (!empty($_POST["role"])) {
        echo "Rol: " . htmlspecialchars($_POST["role"]) . "</br>";
    }
}
?>