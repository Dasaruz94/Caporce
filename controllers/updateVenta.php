<?php

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'delete'){

    $sql = 'DELETE FROM producto_venta WHERE id_ventas = "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql = 'DELETE FROM ventas WHERE id_ventas = "'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            header('Location: ../view/ventas.php?id='.$_GET['idCliente'].'');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    }
    mysqli_close($mysqli);

}
if($_GET['a'] == 'borraCliente'){

    $sql = 'UPDATE clientes SET activo="0" WHERE id_clientes LIKE "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/clientes.php');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

} if($_GET['a'] == 'guardar'){


    $nombre = $_POST['nombre_cliente'];

    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $sql = 'UPDATE clientes SET nombre_cliente = "'.$nombre.'", direccion = "'.$direccion.'", telefono = "'.$telefono.'" WHERE id_clientes like "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        header('Location: ../view/clientes.php');
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}
if($_GET['a'] == 'modificaNota'){


    $sql = 'DELETE FROM producto_venta WHERE id_ventas = "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql = 'UPDATE ventas SET precio_total = "'.$_POST['total'].'", persona_creacion = "'.$_SESSION['id'].'" WHERE id_ventas = "'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            $paso2 = true;
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    if($paso2){

        $idVentas = $_GET['id'];
        $contador1 = 0;
        $contador2 = 10;
        while($contador1 < $contador2){

            if(@isset($_POST['descripcion_'.$contador1])){

                $cantidad = $_POST['cantidad_'.$contador1];
                $descripcion = $_POST['descripcion_'.$contador1];
                $kilos = $_POST['kilos_'.$contador1];
                $precio_unitario = $_POST['precio_unitario_'.$contador1];
                $importe = $_POST['importe_'.$contador1];

                $sql = "INSERT INTO producto_venta (id_ventas,id_clientes,cantidad,descripcion,kilos,precio_unitario,importe,fecha_creacion,persona_creacion,activo) VALUES ('".$idVentas."', '".$_GET['idCliente']."', '".$cantidad."', '".$descripcion."', '".$kilos."', '".$precio_unitario."', '".$importe."', '".date('Y-m-d h:i:s')."','".$_SESSION['id']."', '1')";

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

            while($contador1 < $contador2){
                if(@isset($_POST['descripcion_'.$contador1])){

                    $cantidad2 = $_POST['cantidad_'.$contador1];
                    $kilos2 = $_POST['kilos_'.$contador1];
                    $str = strtolower(@$_POST['descripcion_'.$contador1]);

                    $pieza  = $str;
                    $piezasola = explode(" ", $pieza);

                    if(@$piezasola[1] == "sucia" || @$piezasola[1] == "sucio"){

                        $str = $piezasola[0];
                    }

                    $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos

                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
                    $resultado = $mysqli->query($consulta);

                    while ($row=mysqli_fetch_row($resultado))
                    {

                        $str1 = strtolower($row[1]);
                        if(@$str == $str1){

                            $tablaDeMysql1 = "inventario_combinacion"; //Define el nombre de la tabla donde estan los datos

                            $consulta1 = "SELECT * FROM ".$tablaDeMysql1." WHERE activo LIKE 1 AND id_combinacion LIKE '".$row[0]."'";
                            $resultado1 = $mysqli->query($consulta1);

                            while ($row1=mysqli_fetch_row($resultado1))
                            {

                                $peso = $kilos2 * $row1[4];
                                $cantidad = $cantidad2 * $row1[3];
                                $sql1 = 'UPDATE inventario SET peso = peso - ('.$peso.'), cantidad = cantidad - ('.$cantidad.'), persona_modificacion="'.$_SESSION['id'].'" WHERE id_inventario ="'.$row1[2].'"';


                                mysqli_query($mysqli, $sql1);
                            }

                        }

                    }


                    $pieza  = $str;
                    $piezasola = explode(" ", $pieza);


                    $sql = 'UPDATE inventario SET cantidad = cantidad - ('.$cantidad2.'), peso = peso - ('.$kilos2.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'" AND descripcion LIKE "'.$piezasola[0].'"';

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


        header('Location: ../view/clientes.php');

    }

    mysqli_close($mysqli);

}

if($_GET['a'] == 'pcuenta'){

    $sql1 = 'SELECT * FROM ventas WHERE id_ventas ="'.$_GET['idVenta'].'" ';

    $resultado = $mysqli->query($sql1);


    while ($row=mysqli_fetch_row($resultado))
    {

        $precio = $row[4];
        $folio = $row[2];

    }

    $sql1 = 'SELECT * FROM clientes WHERE id_clientes ="'.$_GET['idCliente'].'" ';

    $resultado = $mysqli->query($sql1);


    while ($row=mysqli_fetch_row($resultado))
    {

        $nombre = $row[1];


    }


    $monto = $_POST['monto'];
    $sql = 'UPDATE ventas SET precio_total = precio_total - ('.$monto.'), fecha_pago="'.date('Y-m-d h:i:s').'" WHERE id_ventas="'.$_GET['idVenta'].'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql1 = 'UPDATE caja SET cantidad = cantidad + ('.$monto.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';
    }
    if (mysqli_query($mysqli, $sql1)) {

        $sql2 = "INSERT INTO ingresos(fecha_ingreso,precio,descripcion,fecha_creacion,persona_creacion,activo) values ('".date('Y-m-d h:i:s')."', '".$monto."','Pago a cuenta de nota ".$folio. ', '.$nombre."', '".date('Y-m-d')."', '".$_SESSION['id']."','1')";
    }

    if (mysqli_query($mysqli, $sql2)) {


        header('Location: ../view/ingresos.php?idCliente='.$_GET['idCliente'].'&idVenta='.$_GET['idVenta'].'');
    }else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);


}

if($_GET['a'] == 'vp1'){

    for ($i = 0; $i <= $_GET['i']; $i++) {

        if(@$_POST['id_'][$i] != "") {

            $sql = 'UPDATE ventas SET status_pago="2", tipo_pago="2", fecha_pago="' . date('Y-m-d h:i:s') . '" WHERE id_ventas="' .  $_POST['id_'][$i] . '"';

            if (mysqli_query($mysqli, $sql)) {

            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }

        }
    }
    mysqli_close($mysqli);
    header('Location: ../view/ventas.php?id=' . $_GET['idCliente'] . '');
}

if($_GET['a'] == 'vp'){

    for ($i = 0; $i <= $_GET['i']; $i++) {

        if(@$_POST['id_'][$i] != ""){

            $sql = 'UPDATE ventas SET status_pago="2", tipo_pago="1", fecha_pago= "'.date('Y-m-d h:i:s').'" WHERE id_ventas="'. $_POST['id_'][$i].'"';

            if (mysqli_query($mysqli, $sql)) {

                $sql1 = 'SELECT * FROM ventas WHERE id_ventas ="'.$_POST['id_'][$i].'" ';

                $resultado = $mysqli->query($sql1);


                while ($row=mysqli_fetch_row($resultado))
                {

                    $precio = $row[4];
                    $folio = $row[2];
                    $consulta1 = "SELECT * FROM clientes WHERE id_clientes LIKE '".$row[1]."'";
                    $resultado1 = $mysqli->query($consulta1);
                    while ($row1=mysqli_fetch_row($resultado1))
                    {
                        $idCliente =$row1[0];
                        $nombre = $row1[1];

                    }

                }


                $sql2 = 'UPDATE caja SET cantidad = cantidad + ('.$precio.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'"';
            }
            if (mysqli_query($mysqli, $sql2)) {

                $sql4 = "INSERT INTO ingresos(fecha_ingreso,precio,descripcion,fecha_creacion,persona_creacion,activo) values ('".date('Y-m-d')."', '".$precio."','Pago total de nota ".$folio.", ".$nombre."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."','1')";
            }

            if (mysqli_query($mysqli, $sql4)) {


            }
            else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }

        }
    }

    mysqli_close($mysqli);

    header('Location: ../view/ingresos.php');


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

    $consulta = "SELECT MAX(id_ventas) FROM ventas";
    $resultado = $mysqli->query($consulta);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
    while ($row=mysqli_fetch_row($resultado))
    {
        $idVentas = $row[0];
        $consulta = "SELECT * FROM ventas WHERE id_ventas LIKE ".$idVentas."";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
        while ($row=mysqli_fetch_row($resultado))
        {
            $folio = $row[2];
        }
    }

    $separado = explode("-", $folio);

    $letra = $separado[0];
    $numero = (int)$separado[1];



    if($numero == 10000){

        $folioBueno = ++$letra.'-'.'1';

    }else{

        $numeroNuevo = $numero + 1;
        $folioBueno = $letra.'-'.$numeroNuevo;

    }


    $sql = "INSERT INTO ventas (id_clientes,folio,chofer,precio_total,status_pago,fecha_venta,tipo_pago,persona_creacion,activo) VALUES ('".$_GET['id']."', '".$folioBueno."', '".$_POST['chofer']."', '".$_POST['total']."', '1', '".date('Y-m-d H:i:s')."', '3','".$_SESSION['id']."', '1')";
    if (mysqli_query($mysqli, $sql)) {

        $paso2 = true;
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    if($paso2){

        $tablaDeMysql = "ventas"; //Define el nombre de la tabla donde estan los datos

        //Checamos si se lleno el campo de usuario en el formulario
        $consulta = "SELECT MAX(id_ventas) FROM ".$tablaDeMysql;
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
        while ($row=mysqli_fetch_row($resultado))
        {
            $idVentas = $row[0];
        }


        $contador1 = 0;
        $contador2 = 12;
        while($contador1 < $contador2){

            if(@isset($_POST['descripcion_'.$contador1])){

                $cantidad = $_POST['cantidad_'.$contador1];
                $descripcion = $_POST['descripcion_'.$contador1];
                $kilos = $_POST['kilos_'.$contador1];
                $precio_unitario = $_POST['precio_unitario_'.$contador1];
                $importe = $_POST['importe_'.$contador1];

                $sql = "INSERT INTO producto_venta (id_ventas,id_clientes,cantidad,descripcion,kilos,precio_unitario,importe,fecha_creacion,persona_creacion,activo) VALUES ('".$idVentas."', '".$_GET['id']."', '".$cantidad."', '".$descripcion."', '".$kilos."', '".$precio_unitario."', '".$importe."', '".date('Y-m-d h:i:s')."','".$_SESSION['id']."', '1')";

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

            while($contador1 < $contador2){
                if(@isset($_POST['descripcion_'.$contador1])){

                    $cantidad2 = $_POST['cantidad_'.$contador1];
                    $kilos2 = $_POST['kilos_'.$contador1];
                    $str = strtolower(@$_POST['descripcion_'.$contador1]);

                    $pieza  = $str;
                    $piezasola = explode(" ", $pieza);

                    if($piezasola[1] == "sucia" || $piezasola[1] == "sucio"){

                        $str = $piezasola[0];
                    }

                    $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos

                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
                    $resultado = $mysqli->query($consulta);

                    while ($row=mysqli_fetch_row($resultado))
                    {

                        $str1 = strtolower($row[1]);
                        if(@$str == $str1){

                            $tablaDeMysql1 = "inventario_combinacion"; //Define el nombre de la tabla donde estan los datos

                            $consulta1 = "SELECT * FROM ".$tablaDeMysql1." WHERE activo LIKE 1 AND id_combinacion LIKE '".$row[0]."'";
                            $resultado1 = $mysqli->query($consulta1);

                            while ($row1=mysqli_fetch_row($resultado1))
                            {

                                $peso = $kilos2 * $row1[4];
                                $cantidad = $cantidad2 * $row1[3];
                                $sql1 = 'UPDATE inventario SET peso = peso - ('.$peso.'), cantidad = cantidad - ('.$cantidad.'), persona_modificacion="'.$_SESSION['id'].'" WHERE id_inventario ="'.$row1[2].'"';


                                mysqli_query($mysqli, $sql1);
                            }

                        }

                    }


                    $pieza  = $str;
                    $piezasola = explode(" ", $pieza);


                    $sql = 'UPDATE inventario SET cantidad = cantidad - ('.$cantidad2.'), peso = peso - ('.$kilos2.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'" AND descripcion LIKE "'.$piezasola[0].'"';

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

        header('Location: equiposPdf.php?idCliente='.$_GET['id'].'&idVenta='.$idVentas);

    }

    mysqli_close($mysqli);

}


if($_GET['a'] == 'updateNota'){

    $tablaDeMysql4 = "producto_venta"; //Define el nombre de la tabla donde estan los datos
    $consulta4 = "SELECT * FROM ".$tablaDeMysql4." WHERE id_ventas LIKE ".$_GET['id'];
    $resultado4 = $mysqli->query($consulta4);

    while ($row4=mysqli_fetch_row($resultado4)){

        $cantidad2 = $row4[3];
        $kilos2 = $row4[5];
        $str = strtolower(@$row4[4]);

        $pieza  = $str;
        $piezasola = explode(" ", $pieza);

        if(@$piezasola[1] == "sucia" || @$piezasola[1] == "sucio"){

            $str = $piezasola[0];
        }

        $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos

        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
        $resultado = $mysqli->query($consulta);

        while ($row=mysqli_fetch_row($resultado))
        {

            $str1 = strtolower($row[1]);
            if(@$str == $str1){

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

        $pieza  = $str;
        $piezasola = explode(" ", $pieza);

        $sql = 'UPDATE inventario SET cantidad = cantidad + ('.$cantidad2.'), peso = peso + ('.$kilos2.'), persona_modificacion="'.$_SESSION['id'].'" WHERE fecha ="'.date('Y-m-d').'" AND descripcion LIKE "'.$piezasola[0].'"';

        if (mysqli_query($mysqli, $sql)) {


            $paso3 = true;
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }


    }
    header('Location: ../forms/actualiza_nota.php?id='.$_GET['idCliente'].'&idVenta='.$_GET['id']);

    mysqli_close($mysqli);

}

if($_GET['a'] == 'ppNota'){


        $sql = 'UPDATE ventas SET tipo_pago = 3, status_pago = 1 ,persona_creacion="'.$_SESSION['id'].'" WHERE id_ventas LIKE "'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {
            mysqli_close($mysqli);

            header('Location: ../view/ventas.php?id='.$_GET['idCliente']);
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }







}


?>