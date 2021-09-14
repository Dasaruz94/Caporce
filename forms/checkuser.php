<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 14/01/16
 * Time: 13:55
 */

sleep(1);
include('../libs/conexion.php');
if($_REQUEST){

    $username 	= $_REQUEST['nombre'];

    $consulta = "select * from usuario where username = '".strtolower($username)."'";

    $resultado = $mysqli->query($consulta);

    if(mysqli_num_rows($resultado) > 0) // not available
    {
        echo '<div id="Error">Usuario ya existente</div>';
    }
    else
    {
        echo '<div id="Success">Disponible</div>';
    }


}