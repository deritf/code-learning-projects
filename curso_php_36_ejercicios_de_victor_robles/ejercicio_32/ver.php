<?php include 'app/includes/header.php'; ?>

<?php
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location:index.php");
}

$id = $_GET["id"];
$user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$id}");
$user = mysqli_fetch_assoc($user_query);
echo "Procesado exitosamente...";

if(!isset($user["user_id"]) || empty($user["user_id"])){
    header("Location:index.php");
}
?>

<h3>
    Usuario: <?php echo $user["name"]." ".$user["surname"]; ?>
</h3>
<p>Email: <?php echo $user["email"]; ?></p>
<p>Biografía: <?php echo $user["bio"]; ?></p>
<a href="index.php">Volver</a>

<?php include 'app/includes/footer.php'; ?>