<?php
require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web con PHP</title>
</head>
<body>
    <h1>Web con PHP</h1>
    <hr>
    <?php if (isset($_SESSION["logged"])) { ?>
        <a href="index.php">Home</a>
        <a href="crear.php">Crear nuevo usuario</a>
        <a href="logout.php" style="color: red;">Cerrar sesión</a>
        <hr>
        <div>
            <h3>Datos del usuario</h3>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION["logged"]["name"]); ?></p>
            <p><strong>Apellidos:</strong> <?= htmlspecialchars($_SESSION["logged"]["surname"]); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["logged"]["email"]); ?></p>
        </div>
    <?php } ?>
