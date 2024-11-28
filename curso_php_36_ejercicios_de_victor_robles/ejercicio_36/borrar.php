<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["logged"]) && $_SESSION["logged"]["role"] === "Administrador") {
    require_once 'app/includes/connect.php';

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = intval($_GET["id"]); // Asegura que el ID sea un número entero

        // Ejecuta la consulta para borrar el usuario
        $delete = mysqli_query($db, "DELETE FROM users WHERE user_id = {$id}");

        if (!$delete) {
            // Registra el error en el log del servidor para depuración
            error_log("Error al borrar el usuario con ID $id: " . mysqli_error($db));
            die("Error al borrar el usuario. Inténtalo más tarde."); // Detiene la ejecución si hay un error
        }
    }
}

// Redirigir siempre al final si no hay errores
header("Location: index.php");
exit();
