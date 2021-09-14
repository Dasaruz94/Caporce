<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 25/01/16
 * Time: 11:06
 */
date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'updateUno'){


    $sql = 'UPDATE derivados SET '.$_GET['p'].' = "'.$_POST['pieza_kilos'].'", persona_creacion="'.$_SESSION['id'].'", persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';




    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/inventario_derivados.php?e=updateU');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}
if($_GET['a'] == 'actualizar'){


    $tablaDeMysql = "derivados"; //Define el nombre de la tabla donde estan los datos


    //Checamos si se lleno el campo de usuario en el formulario


    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
    $resultado = $mysqli->query($consulta);



    $total = mysqli_num_rows($resultado);

    $consulta2 = "SELECT * FROM ".$tablaDeMysql." WHERE id_derivados LIKE ".$total." ";
    $resultado2 = $mysqli->query($consulta2);


    $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);


    $sql = "INSERT INTO derivados (almacen,mascara_cantidad,mascara_peso,lengua_cantidad,lengua_peso,sesos_peso,hueso_cabeza_peso,papada_cabeza_peso,recorte_cabeza_peso,manteca_peso,prensado_peso,sancocho_peso,chicharron_peso,ahumada_cantidad,ahumada_peso,tocino_cantidad,tocino_peso,fecha,fecha_creacion,fecha_modificacion,persona_creacion,persona_modificacion,activo) VALUES ('1', '".$row['mascara_cantidad']."','".$row['mascara_peso']."', '".$row['lengua_cantidad']."','".$row['lengua_peso']."', '".$row['sesos_peso']."','".$row['hueso_cabeza_peso']."','".$row['papada_cabeza_peso']."','".$row['recorte_cabeza_peso']."', '".$row['manteca_peso']."','".$row['prensado_peso']."','".$row['sancocho_peso']."', '".$row['chicharron_peso']."', '".$row['ahumada_cantidad']."','".$row['ahumada_peso']."', '".$row['tocino_cantidad']."','".$row['tocino_peso']."', '".date('Y-m-d')."', '".date('Y-m-d')."', '".date('Y-m-d')."', '".$_SESSION['id']."', '".$_SESSION['id']."', '1')";



    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/inventario_derivados.php?e=updateUT');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}