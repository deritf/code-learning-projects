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

    // Validar rol (asegúrate de que el formulario siempre envía "0" o "1")
    if (isset($_POST["role"]) && ($_POST["role"] === "0" || $_POST["role"] === "1")) {
        $role_validate = true;
    } else {
        $errors["role"] = "El rol no es válido.";
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
                role = '$role',
                image = NULL";

        // Incluir la contraseña solo si se ha proporcionado una nueva
        if (!empty($_POST["password"])) {
            $sql .= ", password = '$hashed_password'";
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
            echo htmlspecialchars($_POST["bio"]); // Mostrar lo ingresado por el usuario si hubo errores
        } else {
            echo htmlspecialchars($user["bio"]); // Mostrar el valor almacenado en la base de datos
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

    <input type="submit" value="Actualizar" name="submit" />
</form>

<?php require_once 'app/includes/footer.php'; ?>
