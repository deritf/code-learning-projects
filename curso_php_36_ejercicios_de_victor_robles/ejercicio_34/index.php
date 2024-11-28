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
    <?php
        while ($row = mysqli_fetch_assoc($users)){ ?>
            <tr>
                <td><?=$row["name"]?></td>
                <td><?=$row["surname"]?></td>
                <td><?=$row["email"]?></td>
                <td>
                    <a href="ver.php?id=<?=$row["user_id"]?>">Ver</a>
                    <a href="editar.php?id=<?=$row["user_id"]?>">Editar</a>
                </td>
            </tr>
        <?php } ?>
</table>

<?php
include 'app/includes/footer.php';
?>