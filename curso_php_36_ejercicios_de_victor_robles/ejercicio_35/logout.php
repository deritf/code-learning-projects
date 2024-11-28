<?php
session_start();

if (isset($_SESSION["logged"])) {
    session_unset();
    session_destroy();
    header("Location: login.php"); // Redirigir al usuario al login o inicio
    exit();
} else {
    header("Location: index.php"); // Redirigir al usuario al inicio si no está logueado
    exit();
}
