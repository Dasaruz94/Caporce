<?php

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['e'] == 'delete'){


    $sql = 'UPDATE compras SET activo="0" WHERE id_compras="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/compras.php?e=deleted');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);



}
 if($_GET['a'] == 'pagarCompra'){


    $sql = 'UPDATE compras SET status_pago="2", tipo_pago="2", fecha_pago="'.date('Y-m-d h:i:s').'" WHERE id_compras="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/compras.php');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);



}
if($_GET['a'] == 'set'){


    $sql = 'UPDATE ventas SET status_pago="2", tipo_pago="1", fecha_pago= "'.date('Y-m-d h:i:s').'" WHERE id_ventas="'.$_GET['idVenta'].'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql1 = 'SELECT precio_total FROM ventas WHERE id_ventas="'.$_GET['idVenta'].'" ';
        $resultado = $mysqli->query($sql);
        while ($row=mysqli_fetch_row($resultado))
        {

            $precio = $row[0];



            $sql2 = 'UPDATE caja SET cantidad = cantidad + ('.$precio.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';
        }
        if (mysqli_query($mysqli, $sql2)) {

            header('Location: ../view/ventas.php?id='.$_GET['idCliente'].'');
        }
        else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
    mysqli_close($mysqli);

}
if($_GET['e'] == 'set1'){

    $sql = 'UPDATE ventas SET status_pago="2", tipo_pago="2", fecha_pago="'.date('Y-m-d h:i:s').'" WHERE id_ventas="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/ventas.php?id='.$_GET['idCliente'].'');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}
if($_GET['a'] == 'create'){

    $sql = "INSERT INTO clientes (nombre_cliente,direccion,telefono,fecha_creacion,fecha_modificacion,activo) VALUES ('".$_POST['nombre_cliente']."', '".$_POST['direccion']."', '".$_POST['telefono']."', '".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/clientes.php?e=updateVenta');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}

if($_GET['a'] == 'add'){

    if($_POST['status_pago'] == 1){

        $sql = "INSERT INTO compras (proveedor,precio_total,status_pago,fecha_compra,fecha_credito,activo) VALUES ('".$_POST['proveedor']."','".$_POST['total']."','".$_POST['status_pago']."', '".date('Y-m-d h:i:s')."','".$_POST['fecha_credito']."', '1')";

    }else{

        $sql = "INSERT INTO compras (proveedor,precio_total,status_pago,fecha_compra,fecha_pago,tipo_pago,activo) VALUES ('".$_POST['proveedor']."','".$_POST['total']."','".$_POST['status_pago']."', '".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."','".$_POST['tipo_pago']."', '1')";

    }

   if (mysqli_query($mysqli, $sql)) {

        $paso2 = true;

   } else {
       echo "Error updating record: " . mysqli_error($mysqli);
    }

    if($paso2){

        $tablaDeMysql = "compras";


        $consulta = "SELECT MAX(id_compras) FROM ".$tablaDeMysql."";
        $resultado = $mysqli->query($consulta);

        while ($row=mysqli_fetch_row($resultado))
        {
            $idCompras = $row[0];
        }

        $contador1 = 0;
        $contador2 = 10;
        while($contador1 < $contador2){

            if(@isset($_POST['descripcion_'.$contador1])){

                $cantidad = $_POST['cantidad_'.$contador1];
                $descripcion = $_POST['descripcion_'.$contador1];
                $kilos = $_POST['kilos_'.$contador1];
                $precio_unitario = $_POST['precio_unitario_'.$contador1];
                $importe = $_POST['importe_'.$contador1];

                $sql = "INSERT INTO producto_compra (id_compras,num_productos,descripcion,kilos,precio_unitario,importe,fecha_creacion,persona_creacion,activo) VALUES ('".$idCompras."', '".$cantidad."', '".$descripcion."', '".$kilos."', '".$precio_unitario."', '".$importe."', '".date('Y-m-d h:i:s')."','".$_SESSION['id']."', '1')";

                if (mysqli_query($mysqli, $sql)) {

                    $contador1 ++;
                    $paso3 = true;
                } else {
                    echo "Error updating record: " . mysqli_error($mysqli);
                }

            }else{
                $contador1 ++;
            }
        }

        if($paso3){
            $contador1 = 0;

            $contador2 = 10;

            while($contador1 < $contador2){
                if(@isset($_POST['descripcion_'.$contador1])){

                    $cantidad2 = $_POST['cantidad_'.$contador1];
                    $kilos2 = $_POST['kilos_'.$contador1];
                    $str = strtolower(@$_POST['descripcion_'.$contador1]);
                    $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos

                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
                    $resultado = $mysqli->query($consulta);

                    while ($row=mysqli_fetch_row($resultado))
                    {
                        if(@$str == $row[1]){

                            $tablaDeMysql1 = "inventario_combinacion"; //Define el nombre de la tabla donde estan los datos

                            $consulta1 = "SELECT * FROM ".$tablaDeMysql1." WHERE activo LIKE 1 AND id_combinacion LIKE '".$row[0]."'";
                            $resultado1 = $mysqli->query($consulta1);

                            while ($row1=mysqli_fetch_row($resultado1))
                            {

                                $peso = $kilos2 * $row1[4];
                                $cantidad = $cantidad2 * $row1[3];
                                $sql1 = 'UPDATE inventario SET peso = peso + ('.$peso.'), cantidad = cantidad + ('.$cantidad.'), persona_modificacion="'.$_SESSION['id'].'" WHERE id_inventario ="'.$row1[2].'"';


                                mysqli_query($mysqli, $sql1);
                            }

                        }

                    }

                    $sql = 'UPDATE inventario SET cantidad = cantidad + ('.$cantidad2.'), peso = peso + ('.$kilos2.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'" AND descripcion LIKE "'.$str.'"';

                    if (mysqli_query($mysqli, $sql)) {

                        $contador1 ++;
                        $paso3 = true;
                    } else {
                        echo "Error updating record: " . mysqli_error($mysqli);
                    }


                    $sql = 'UPDATE inventario SET peso = peso + ('.$kilos2.'), cantidad = cantidad + ('.$cantidad2.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'" AND descripcion LIKE "'.$str.'"';

                    if (mysqli_query($mysqli, $sql)) {

                        $contador1 ++;
                        $paso3 = true;
                    } else {
                        echo "Error updating record: " . mysqli_error($mysqli);
                    }

                }else{
                    $contador1 ++;
                }
            }
        }
        header('Location: ../view/compras.php');

    }

    mysqli_close($mysqli);

}

?>