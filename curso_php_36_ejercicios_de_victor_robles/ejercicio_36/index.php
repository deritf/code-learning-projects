<?php
include 'app/includes/redirect.php';
include 'app/includes/header.php';

$users = mysqli_query($db, "SELECT * FROM users");
$num_total_users = mysqli_num_rows($users);

if($num_total_users > 0){
    $row_per_page = 3;
    $page = false;

    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }

    if(!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page-1)*$row_per_page;
    }

    $total_pages = ceil($num_total_users / $row_per_page);

    $sql="SELECT * FROM users ORDER BY user_id DESC LIMIT {$start},{$row_per_page}";
    $users = mysqli_query($db, $sql);

} else {
    echo "No hay usuarios";
}
?>

<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Ver/Editar</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($users)) { ?>
        <tr>
            <td><?= htmlspecialchars($row["name"]); ?></td>
            <td><?= htmlspecialchars($row["surname"]); ?></td>
            <td><?= htmlspecialchars($row["email"]); ?></td>
            <td><?= htmlspecialchars($row["role"]); ?></td>
            <td>
                <a href="ver.php?id=<?= $row["user_id"]; ?>">Ver</a>
                <a href="editar.php?id=<?= $row["user_id"]; ?>">Editar</a>
                <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"]["role"] === "Administrador") { ?>
                    <a href="borrar.php?id=<?= $row["user_id"]; ?>">Borrar</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if ($num_total_users > 0) { ?>
    <ul style="list-style-type: none; display: flex; justify-content: center; gap: 5px; padding: 0;">
        <?php if ($page > 1) { ?>
            <li><a href="index.php?page=<?= $page - 1; ?>">&#60;</a></li>
        <?php } ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li>
                <a href="index.php?page=<?= $i; ?>"
                   style="<?= $i == $page ? 'font-weight: bold; text-decoration: underline;' : ''; ?>">
                   <?= $i; ?>
                </a>
            </li>
        <?php } ?>

        <?php if ($page < $total_pages) { ?>
            <li><a href="index.php?page=<?= $page + 1; ?>">&#62;</a></li>
        <?php } ?>
    </ul>
<?php } ?>



<?php include 'app/includes/footer.php'; ?>
