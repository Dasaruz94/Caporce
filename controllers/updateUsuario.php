<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 14/01/16
 * Time: 13:36
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'updateS'){

   $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);



    $sql = 'UPDATE usuario SET username="'.$_POST['nombre'].'", password="'.$b.'", tipo_usuario="'.$_POST['tipo_usuario'].'" WHERE id_usuario="'.$_SESSION['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/usuarios.php?e=update');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}
if($_GET['a'] == 'add'){

    if($_POST['nombre'] == ''){
        header('Location: ../forms/alta_usuario.php?e=notFull');
    }else{


    $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);



    $sql = "INSERT INTO usuario (username,password,tipo_usuario,activo) VALUES ('".$_POST['nombre']."', '".$b."', '".$_POST['tipo_usuario']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/usuarios.php?e=add');
    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }
    }

}

if($_GET['a'] == 'delete'){

    $sql = 'UPDATE usuario SET activo="0" WHERE id_usuario="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/usuarios.php?e=deleted');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);



}

if($_GET['a'] == 'update'){

    $sql = 'UPDATE usuario SET username="'.$_POST['nombre'].'", tipo_usuario="'.$_POST['tipo_usuario'].'" WHERE id_usuario="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/usuarios.php?e=update');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}



