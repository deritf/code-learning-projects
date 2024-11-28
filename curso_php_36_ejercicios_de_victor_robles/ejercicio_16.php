<h2>Ejercicio 16</h2>
<?php
echo '<hr>';

$tabla = array(
    "Frutas" => array("Manzana", "Naranja", "Sandía", "Fresas"),
    "Deportes" => array("Futbol", "Tenis", "Baloncesto", "Beisbol"),
    "Idiomas" => array("Español", "Inglés", "Francés", "Italiano")
);

    var_dump($tabla);

?>

<table border="1" style="border-collapse: collapse; width: 50%; text-align: center;">
    <thead>
        <tr>
            <th>Frutas</th>
            <th>Deportes</th>
            <th>Idiomas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Determinar la cantidad máxima de elementos en las subcategorías
        $maxFilas = max(array_map('count', $tabla));
        for ($i = 0; $i < $maxFilas; $i++): ?>
            <tr>
                <td><?php echo isset($tabla["Frutas"][$i]) ? $tabla["Frutas"][$i] : ""; ?></td>
                <td><?php echo isset($tabla["Deportes"][$i]) ? $tabla["Deportes"][$i] : ""; ?></td>
                <td><?php echo isset($tabla["Idiomas"][$i]) ? $tabla["Idiomas"][$i] : ""; ?></td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>