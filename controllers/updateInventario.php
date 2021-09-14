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

if($_GET['e'] == 'borraCombinacion'){



    $sql = 'UPDATE combinacion SET activo="0" WHERE id_combinacion="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/combinacion.php?e=deleted');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);



}
if($_GET['a'] == 'updateUno'){
    $sql = 'UPDATE inventario SET peso = "'.$_POST['kilos'].'", cantidad ="'.$_POST['cantidad'].'" , persona_creacion="'.$_SESSION['id'].'", persona_modificacion="'.$_SESSION['id'].'" WHERE id_inventario LIKE "'.$_GET['id'].'" AND fecha ="'.date('Y-m-d').'"';




    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/inventario.php?e=updateU');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}if($_GET['a'] == 'combinacion'){

    $sql = "INSERT INTO combinacion (descripcion,fecha_creacion,fecha_modificacion,persona_creacion,persona_modificacion,activo) VALUES ('".$_POST['descripcion']."','".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."','".$_SESSION['id']."','".$_SESSION['id']."','1')";

    mysqli_query($mysqli, $sql);

    $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos

    //Checamos si se lleno el campo de usuario en el formulario
    $consulta = "SELECT MAX(id_combinacion) FROM ".$tablaDeMysql."";
    $resultado = $mysqli->query($consulta);

    while ($row=mysqli_fetch_row($resultado))
    {
        $idCombinacion = $row[0];
    }

    $tablaDeMysql = "inventario"; //Define el nombre de la tabla donde estan los datos

    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
    $resultado = $mysqli->query($consulta);

    while ($row=mysqli_fetch_row($resultado))
    {
        if(@$_POST['pieza'][$row[0]] != ""){


            $sql = "INSERT INTO inventario_combinacion (id_combinacion,id_inventario,cantidad,peso,fecha_creacion,fecha_modificacion,persona_creacion,persona_modificacion,activo) VALUES ('".$idCombinacion."','".$row[0]."','".$_POST["cantidad_".$row[1].""]."','".$_POST["peso_".$row[1].""]."','".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."','".$_SESSION['id']."','".$_SESSION['id']."','1')";



            mysqli_query($mysqli, $sql);
        }

    }
    mysqli_close($mysqli);

        header('Location: ../view/combinacion.php');

}

if($_GET['a'] == 'create'){
    $str = strtolower(@$_POST['descripcion']);
    $sql = 'INSERT INTO inventario (descripcion,peso,cantidad,fecha,fecha_creacion,persona_creacion,activo)  VALUES("'.$str.'","0","0", "'.date('Y-m-d').'","'.date('Y-m-d ').'","'.$_SESSION['id'].'", "1")';




    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/inventario.php?e=updateU');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}

if($_GET['a'] == 'actualizar'){



    $sql = "UPDATE inventario SET fecha = '".date('Y-m-d ')."'";
    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/inventario.php?e=updateUT');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}