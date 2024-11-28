<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once 'app/includes/connect.php';

if (isset($_POST["submit"])) {
    $email = trim($_POST["email"]);
    $password = sha1($_POST["password"]);

    // Corrige el nombre de la columna a "email"
    $sql = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $_SESSION["logged"] = mysqli_fetch_assoc($login);
        header("Location: index.php");
        exit();
    } else {
        $_SESSION["error_login"] = "¡Login incorrecto!"; // Usa una clave consistente
        header("Location: login.php");
        exit();
    }
}