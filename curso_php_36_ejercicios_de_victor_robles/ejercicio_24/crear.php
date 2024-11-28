<?php require_once 'app/includes/header.php'; ?>

<h2>Ejercicio 24</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" />
    <br /><br />

    <label for="surname">Apellido:</label>
    <input type="text" name="surname" id="surname" />
    <br /><br />

    <label for="bio">Biografía:</label>
    <textarea name="bio" id="bio"></textarea>
    <br /><br />

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" />
    <br /><br />

    <label for="image">Imagen:</label>
    <input type="file" name="image" id="image" />
    <br /><br />

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" />
    <br /><br />

    <label for="role">Rol:</label>
    <select name="role" id="role">
        <option value="0">Normal</option>
        <option value="1">Administrador</option>
    </select>
    <br /><br />

    <input type="submit" value="Enviar" />
</form>

<?php require_once 'app/includes/footer.php'; ?>