<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 3/02/16
 * Time: 10:22
 */
SESSION_START();
if(isset($_SESSION['nombre'])) {

   if($_SESSION['tipo_usuario'] != 2){

       $total=2;


   }else{

   }
}


if($total==2){

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include 'librerias.php';
    ?>

    <body id="mimin" class="dashboard">
    <!-- start: Header -->

    <!-- end: Header -->

    <div class="container-fluid mimin-wrapper">

        <!-- start:Left Menu -->
        <?php
        include 'menu.php';
        ?>

        <div id="content">

            <?php
            include'../libs/conexion.php';

            ?>


            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Caja del dia: <?php echo date('d-m-Y h:i a'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="panel">
            </div>

                <div class="col-md-12" style="padding:20px;">
                    <?php
                    $tablaDeMysql = "caja"; //Define el nombre de la tabla donde estan los datos





                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND fecha = '".date('Y-m-d')."' ";
                    $resultado_caja = $mysqli->query($consulta);

                    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                    while ($row=mysqli_fetch_row($resultado_caja))
                    {

                        $caja = $row[1];


                    }

                    ?>
                <div class="col-md-4">
                    <div class="panel box-v1">
                        <div class="panel-heading bg-white border-none">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                <h4 class="text-left">Dinero en caja</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>
                                    <span class="fa fa-money icons icon text-right"></span>
                                </h4>


                            </div>

                        </div>
                        <div class="panel-body text-center">
                            <h1><?php $numero = $caja;
                                echo '$'.number_format($numero,2); ?></h1>
                            <p>En caja</p>
                            <hr/>

                            <a href="../controllers/updateCaja.php?a=actualizar">
                                <input type="button" class="btn btn-round btn-info" value="Actualizar"/></a>

                        </div>
                    </div>
                </div>

                <?php
                $tabla1 = "ingresos";
                $co2 = "SELECT * FROM ".$tabla1." WHERE activo LIKE 1 AND fecha_ingreso = '".date('Y-m-d')."' ";
                $result2 = $mysqli->query($co2);
                $co2 = "SELECT SUM(precio) FROM ".$tabla1." WHERE activo LIKE 1 AND fecha_ingreso= '".date('Y-m-d')."' ";
                $result01 = $mysqli->query($co2);
                $total_movimientos_ingreso = mysqli_num_rows($result2); //Contamos la cantidad de filas que nos arrojo el resultado

                while ($row=mysqli_fetch_row($result01))
                {
                    $total1 = $row[0];


                ?>
                    <div class="col-md-4">
                    <div class="panel box-v1">
                        <div class="panel-heading bg-white border-none">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                <h4 class="text-left">Ingresos de venta</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>
                                    <span class="fa fa-money text-right"></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body text-center">
                            <h1><?php $numero = $total1;
                                echo '$'.number_format($numero,2);?></h1>
                            <p><?php echo $total_movimientos_ingreso; ?> Movimientos</p>
                            <hr/>
                            <a href="../view/ingresos.php">
                                <input type="button" class="btn btn-round btn-info" value="Ver Mas"/></a>
                        </div>
                    </div>
                </div>
                    <?php } ?>
<?php
// consulta para los gastos
$tabla = "gastos";
$con1 = "SELECT * FROM ".$tabla." WHERE activo LIKE 1 AND fecha_pago = '".date('Y-m-d')."' ";
$result1 = $mysqli->query($con1);
$con = "SELECT SUM(precio) FROM ".$tabla." WHERE activo LIKE 1 AND fecha_pago= '".date('Y-m-d')."' ";
$result = $mysqli->query($con);
$total_movimientos = mysqli_num_rows($result1); //Contamos la cantidad de filas que nos arrojo el resultado

while ($row=mysqli_fetch_row($result))
{
    $total = $row[0];


?>
                <div class="col-md-4">
                    <div class="panel box-v1">
                        <div class="panel-heading bg-white border-none">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                <h4 class="text-left">Gasto</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>
                                    <span class="icon-basket-loaded icons icon text-right"></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body text-center">
                            <h1><?php $numero = $total;
                                echo '$'.number_format($numero,2);?></h1>
                            <p><?php echo $total_movimientos; ?> Movimientos</p>
                            <hr/>
                            <a href="../view/gastos.php">
                            <input type="button" class="btn btn-round btn-info" value="Ver Mas"/></a>
                        </div>


                    </div>
                </div>

                </div>
        <?php } ?>

            </div>



        </div>


    </body>
    </html>
<?php

}else{

    header('Location: ../index.php?e=wrong1');
}

?>




