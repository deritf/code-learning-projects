<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'app/includes/header.php';
?>

<h2>Identifícate</h2>

<?php
if (isset($_SESSION["error_login"])) {
    echo "<p style='color: red;'>" . $_SESSION["error_login"] . "</p>";
    unset($_SESSION["error_login"]);
}
?>

<form action="login-user.php" method="post">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit" name="submit">Iniciar sesión</button>
</form>

<?php include 'app/includes/footer.php'; ?>
