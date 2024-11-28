<?php
require_once 'connect.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id int(255) auto_increment not null,
    name varchar(50),
    surname varchar(255),
    bio text,
    email varchar(255),
    password varchar(255),
    role varchar(20),
    image varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(user_id)
);";

$create_usuarios_table = mysqli_query($db, $sql);


$sql1 = "INSERT INTO users (name, surname, bio, email, password, role, image)
VALUES ('Juan', 'Pérez', 'Soy un programador apasionado.', 'juan.perez@example.com', '".sha1('123456fd')."', 'Administrador', NULL)";
mysqli_query($db, $sql1);

$sql2 = "INSERT INTO users (name, surname, bio, email, password, role, image)
VALUES ('María', 'López', 'Me encanta viajar y aprender idiomas.', 'maria.lopez@example.com', '".sha1('abcdeffdf')."', 'Usuario', NULL)";
mysqli_query($db, $sql2);

$sql3 = "INSERT INTO users (name, surname, bio, email, password, role, image)
VALUES ('Carlos', 'García', 'Desarrollador de software con experiencia en PHP.', 'carlos.garcia@example.com', '".sha1('contraseñaSegura')."', 'Administrador', NULL)";
mysqli_query($db, $sql3);

$sql4 = "INSERT INTO users (name, surname, bio, email, password, role, image)
VALUES ('Ana', 'Martínez', 'Diseñadora gráfica y artista digital.', 'ana.martinez@example.com', '".sha1('gráficos123')."', 'Usuario', NULL)";
mysqli_query($db, $sql4);

$sql5 = "INSERT INTO users (name, surname, bio, email, password, role, image)
VALUES ('Luis', 'Hernández', 'Especialista en marketing digital.', 'luis.hernandez@example.com', '".sha1('marketing2023')."', 'Usuario', NULL)";
mysqli_query($db, $sql5);

$insert_user = mysqli_query($db, $sql);

// Esto es muy útil para detectar posibles errores de sintaxis.
//echo mysqli_error($db);

if($create_usuarios_table){
    echo "La tabla users ha sido creada correctamente...";
}
?>