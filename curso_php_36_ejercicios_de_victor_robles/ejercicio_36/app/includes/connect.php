<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = new mysqli("localhost", "root", "admin", "cursophp");

// Manejo de errores de conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

mysqli_query($db, "SET NAMES 'utf8';");
?>