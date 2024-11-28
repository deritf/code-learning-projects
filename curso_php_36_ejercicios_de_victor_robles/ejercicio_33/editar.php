<?php
require_once 'app/includes/header.php';

if (!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = $_GET["id"];
$user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$id}");
$user = mysqli_fetch_assoc($user_query);

if (!$user) {
    header("Location: index.php");
    exit();
}

function showError($errors, $field) {
    if (isset($errors[$field])) {
        return $errors[$field];
    }
    return '';
}

function setValueField($data, $field) {
    if (isset($data[$field])) {
        echo "value='" . htmlspecialchars($data[$field]) . "'";
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

    // Validación opcional para la contraseña
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) >= 6) {
            $password_validate = true;
            $hashed_password = sha1($_POST["password"]); // Cifrar la nueva contraseña
        } else {
            $errors["password"] = "La contraseña debe tener al menos 6 caracteres.";
        }
    }

    // Validar rol
    if (isset($_POST["role"]) && ($_POST["role"] === "0" || $_POST["role"] === "1")) {
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

            // Generar un nombre único para la imagen basado en el ID del usuario
            // En "crear.php" el ID aún no existe, así que usamos uniqid y más entropía
            $new_image_name = "profile_" . uniqid("", true) . "." . $extension;

            // Ruta completa
            $new_image_path = $upload_dir . $new_image_name;

            // Mover la imagen a la carpeta uploads
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path)) {
                $image = $new_image_name;
            } else {
                $errors["image"] = "Error al subir la imagen.";
            }
        } else {
            $errors["image"] = "Formato de imagen no permitido. Solo JPG, PNG y GIF.";
        }
    }

    // Actualizar datos del usuario si no hay errores
    if (count($errors) == 0) {
        $name = mysqli_real_escape_string($db, $_POST["name"]);
        $surname = mysqli_real_escape_string($db, $_POST["surname"]);
        $bio = mysqli_real_escape_string($db, $_POST["bio"]);
        $email = mysqli_real_escape_string($db, $_POST["email"]);
        $role = $_POST["role"] == "1" ? "Administrador" : "Usuario";

        // Construir la consulta de actualización
        $sql = "UPDATE users SET
                name = '$name',
                surname = '$surname',
                bio = '$bio',
                email = '$email',
                role = '$role'";

        // Incluir la contraseña solo si se ha proporcionado una nueva
        if (!empty($_POST["password"])) {
            $sql .= ", password = '$hashed_password'";
        }

        // Incluir la nueva imagen si se subió
        if ($new_image) {
            $sql .= ", image = '$new_image'";
        }

        $sql .= " WHERE user_id = $id";

        $update_user = mysqli_query($db, $sql);

        if ($update_user) {
            $success = true;
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar el usuario: " . mysqli_error($db);
        }
    }
}

?>

<h2>Editar usuario <?= htmlspecialchars($user["user_id"]) . " - " . htmlspecialchars($user["name"]) . " " . htmlspecialchars($user["surname"]) ?> </h2>

<form action="editar.php?id=<?= $user["user_id"] ?>" method="POST" enctype="multipart/form-data">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" <?php setValueField($user, "name"); ?> />
    <div><?php if (isset($errors["name"])) echo showError($errors, "name"); ?></div>
    <br /><br />

    <label for="surname">Apellido:</label>
    <input type="text" name="surname" id="surname" <?php setValueField($user, "surname"); ?> />
    <div><?php if (isset($errors["surname"])) echo showError($errors, "surname"); ?></div>
    <br /><br />

    <label for="bio">Biografía:</label>
    <textarea name="bio" id="bio"><?php
        if (!$success && isset($_POST["bio"])) {
            echo htmlspecialchars($_POST["bio"]);
        } else {
            echo htmlspecialchars($user["bio"]);
        }
    ?></textarea>
    <div><?php if (isset($errors["bio"])) echo showError($errors, "bio"); ?></div>
    <br /><br />

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" <?php setValueField($user, "email"); ?> />
    <div><?php if (isset($errors["email"])) echo showError($errors, "email"); ?></div>
    <br /><br />

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" />
    <div><?php if (isset($errors["password"])) echo showError($errors, "password"); ?></div>
    <br /><br />

    <label for="role">Rol:</label>
    <select name="role" id="role">
        <option value="0" <?php if ((isset($_POST["role"]) && $_POST["role"] == "0") || (!isset($_POST["role"]) && $user["role"] == "Usuario")) echo "selected"; ?>>Normal</option>
        <option value="1" <?php if ((isset($_POST["role"]) && $_POST["role"] == "1") || (!isset($_POST["role"]) && $user["role"] == "Administrador")) echo "selected"; ?>>Administrador</option>
    </select>
    <div><?php if (isset($errors["role"])) echo showError($errors, "role"); ?></div>
    <br /><br />

        <label for="image">Imagen de perfil:</label>
    <?php if ($user["image"] != null) { ?>
        <img src="uploads/<?php echo $user["image"]; ?>" width="120"/>
        <br> <!-- Salto de línea añadido -->
    <?php } ?>
    <input type="file" name="image" id="image">
    <div><?php if (isset($errors["image"])) echo showError($errors, "image"); ?></div>
    <br /><br />

    <input type="submit" value="Actualizar" name="submit" />
</form>

<?php require_once 'app/includes/footer.php'; ?>
