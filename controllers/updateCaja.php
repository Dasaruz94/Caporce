<?php

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'actualizar'){


$tablaDeMysql = "caja"; //Define el nombre de la tabla donde estan los datos


    $consulta = "SELECT MAX(id_caja) FROM caja";
    $resultado = $mysqli->query($consulta);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
    while ($row=mysqli_fetch_row($resultado))
    {
        $idCaja = $row[0];
    }

$consulta2 = "SELECT * FROM caja WHERE id_caja LIKE ".$idCaja."";
$resultado2 = $mysqli->query($consulta2);


    while ($row2=mysqli_fetch_row($resultado2))
    {
        $cantidad = $row2[1];
    }

$sql = "INSERT INTO caja (cantidad,fecha,fecha_creacion,fecha_modificacion,persona_creacion,persona_modificacion,activo) VALUES ('".$cantidad."','".date('Y-m-d h:i:s')."', '".date('Y-m-d h:i:s')."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".$_SESSION['id']."', '1')";


if (mysqli_query($mysqli, $sql)) {

header('Location: ../view/caja.php');
} else {
echo "Error updating record: " . mysqli_error($mysqli);
}

mysqli_close($mysqli);

}

?>