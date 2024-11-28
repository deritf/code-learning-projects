<?php
require_once 'app/includes/header.php';

function showError($errors, $field) {
    if (isset($errors[$field])) {
        return $errors[$field];
    }
    return '';
}

function setValueField($errors, $field) {
    if (isset($errors) && count($errors) >= 1 && isset($_POST[$field])) {
        echo "value='" . htmlspecialchars($_POST[$field]) . "'";
    }
}

$errors = [];
$success = false;

// Procesar el formulario
if (isset($_POST["submit"])) {
    // Validaciones de los campos
    if (!empty($_POST["name"]) && strlen($_POST["name"]) <= 20 && !is_numeric($_POST["name"]) && !preg_match("/[0-9]/", $_POST["name"])) {
        $name_validate = true;
    } else {
        $errors["name"] = "El nombre no es válido.";
    }

    if (!empty($_POST["surname"]) && strlen($_POST["surname"]) <= 20 && !is_numeric($_POST["surname"]) && !preg_match("/[0-9]/", $_POST["surname"])) {
        $surname_validate = true;
    } else {
        $errors["surname"] = "El apellido no es válido.";
    }

    if (!empty($_POST["bio"])) {
        $bio_validate = true;
    } else {
        $errors["bio"] = "La biografía no puede estar vacía.";
    }

    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $errors["email"] = "El email no es válido.";
    }

    if (!empty($_POST["password"]) && strlen($_POST["password"]) >= 6) {
        $password_validate = true;
    } else {
        $errors["password"] = "Introduce una contraseña que cumpla con los parámetros básicos de seguridad.";
    }

    if (!empty($_POST["role"])) {
        $role_validate = true;
    } else {
        $errors["role"] = "El rol no es válido.";
    }

    // Validación de la imagen
    $image = NULL;
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($_FILES["image"]["type"], $allowed_types)) {
            // Verificar si la carpeta "uploads" existe, si no, crearla
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Crear la carpeta con permisos 0755
            }

            // Extraer la extensión del archivo
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            // Generar el nombre único usando un identificador único
            $new_image_name = "profile_" . uniqid("", true) . "." . $extension;

            // Ruta completa
            $new_image_path = $upload_dir . $new_image_name;

            // Mover la imagen a la carpeta uploads
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path)) {
                $image = $new_image_name; // Asignar el nombre generado a $image
            } else {
                $errors["image"] = "Error al subir la imagen.";
            }
        } else {
            $errors["image"] = "Formato de imagen no permitido. Solo JPG, PNG y GIF.";
        }
    }

    // INSERTAR USUARIOS EN LA BASE DE DATOS
    if (count($errors) == 0) {
        // Escapar valores y mapear el rol
        $name = mysqli_real_escape_string($db, $_POST["name"]);
        $surname = mysqli_real_escape_string($db, $_POST["surname"]);
        $bio = mysqli_real_escape_string($db, $_POST["bio"]);
        $email = mysqli_real_escape_string($db, $_POST["email"]);
        $hashed_password = sha1($_POST["password"]);
        $role = $_POST["role"] == "1" ? "Administrador" : "Usuario";

        $sql = "INSERT INTO users (name, surname, bio, email, password, role, image)
                VALUES (
                    '$name',
                    '$surname',
                    '$bio',
                    '$email',
                    '$hashed_password',
                    '$role',
                    " . ($image ? "'$image'" : "NULL") . "
                )";

        $insert_user = mysqli_query($db, $sql);

        if ($insert_user) {
            $success = true;
            echo "Usuario insertado correctamente.";
        } else {
            echo "Error al insertar el usuario: " . mysqli_error($db);
        }
    }
}
?>

<h2>Crear usuario</h2>

<form action="crear.php" method="POST" enctype="multipart/form-data">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" <?php setValueField($errors, "name"); ?> />
    <div><?php if (isset($errors["name"])) echo showError($errors, "name"); ?></div>
    <br /><br />

    <label for="surname">Apellido:</label>
    <input type="text" name="surname" id="surname" <?php setValueField($errors, "surname"); ?> />
    <div><?php if (isset($errors["surname"])) echo showError($errors, "surname"); ?></div>
    <br /><br />

    <label for="bio">Biografía:</label>
    <textarea name="bio" id="bio"><?php if (!$success && isset($_POST["bio"])) echo htmlspecialchars($_POST["bio"]); ?></textarea>
    <div><?php if (isset($errors["bio"])) echo showError($errors, "bio"); ?></div>
    <br /><br />

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" <?php setValueField($errors, "email"); ?> />
    <div><?php if (isset($errors["email"])) echo showError($errors, "email"); ?></div>
    <br /><br />

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" />
    <div><?php if (isset($errors["password"])) echo showError($errors, "password"); ?></div>
    <br /><br />

    <label for="image">Imagen de perfil:</label>
    <input type="file" name="image" id="image" />
    <div><?php if (isset($errors["image"])) echo showError($errors, "image"); ?></div>
    <br /><br />

    <label for="role">Rol:</label>
    <select name="role" id="role">
        <option value="0" <?php if (isset($_POST["role"]) && $_POST["role"] == "0") echo "selected"; ?>>Normal</option>
        <option value="1" <?php if (isset($_POST["role"]) && $_POST["role"] == "1") echo "selected"; ?>>Administrador</option>
    </select>
    <div><?php if (isset($errors["role"])) echo showError($errors, "role"); ?></div>
    <br /><br />

    <input type="submit" value="Enviar" name="submit" />
</form>

<?php require_once 'app/includes/footer.php'; ?>
