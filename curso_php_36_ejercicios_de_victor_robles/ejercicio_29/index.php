<?php
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
                <form action="view_user.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$row['user_id']?>">
                    <button type="submit">Ver</button>
                </form>
                <form action="edit_user.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?=$row['user_id']?>">
                    <button type="submit">Editar</button>
                </form>
                </td>
            </tr>
        <?php } ?>
</table>

<?php
include 'app/includes/footer.php';
?>