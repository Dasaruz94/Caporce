<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22/01/16
 * Time: 14:55
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'delete'){

$sql = 'SELECT * FROM gastos WHERE id_gastos = "'.$_GET['id'].'"';
    $resultado = $mysqli->query($sql);
    while ($row=mysqli_fetch_row($resultado))
    {

        $cantidad = $row[2];


    }

    $sql = 'DELETE FROM gastos WHERE id_gastos="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {
        $sql = 'UPDATE caja SET cantidad = cantidad + ('.$cantidad.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';

        if (mysqli_query($mysqli, $sql)) {

            header('Location: ../view/gastos.php?e=deleted');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);



}
if($_GET['a'] == 'create'){


    $sql = "INSERT INTO gastos (fecha_pago,precio,descripcion,fecha_creacion,activo) VALUES ('".date('Y-m-d')."', '".$_POST['precio']."', '".$_POST['descripcion']."', '".date('Y-m-d h:i:s')."', '1')";




    if (mysqli_query($mysqli, $sql)) {

        $sql = 'UPDATE caja SET cantidad = cantidad - ('.$_POST['precio'].'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';




        if (mysqli_query($mysqli, $sql)) {

            header('Location: ../view/gastos.php?e=updateGasto1');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
    mysqli_close($mysqli);

}
?>