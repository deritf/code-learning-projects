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

if($create_usuarios_table){
    echo "La tabla users ha sido creada correctamente...";
}
?>