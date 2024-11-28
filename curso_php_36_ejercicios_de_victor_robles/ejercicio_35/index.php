<?php
include 'app/includes/redirect.php';
include 'app/includes/header.php';

$users = mysqli_query($db, "SELECT * FROM users");
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

<?php include 'app/includes/footer.php'; ?>
