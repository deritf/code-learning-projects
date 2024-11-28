<?php include 'app/includes/header.php';
include 'app/includes/redirect.php';
?>

<?php
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location:index.php");
}

$id = $_GET["id"];
$user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$id}");
$user = mysqli_fetch_assoc($user_query);

if (!$user) {
    header("Location:index.php");
}
?>

<h3>
    Usuario: <?php echo htmlspecialchars($user["name"]) . " " . htmlspecialchars($user["surname"]); ?>
</h3>
<p>Email: <?php echo htmlspecialchars($user["email"]); ?></p>
<p>Biografía: <?php echo nl2br(htmlspecialchars($user["bio"])); ?></p>

<!-- Mostrar la imagen de perfil si existe -->
<?php if (!empty($user["image"])): ?>
    <p>Imagen de perfil:</p>
    <img src="uploads/<?php echo htmlspecialchars($user["image"]); ?>" alt="Imagen de perfil" width="150">
<?php else: ?>
    <p>No se ha subido una imagen de perfil.</p>
<?php endif; ?>

<?php include 'app/includes/footer.php'; ?>