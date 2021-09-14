<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 19/02/16
 * Time: 9:53
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>
        <html lang="es">

        <?php
        include '../view/librerias.php';
        include '../view/menu.php';

        ?>

        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/nouislider.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/ionrangeslider/ion.rangeSlider.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/bootstrap-material-datetimepicker.css"/>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="../asset/js/plugins/moment.min.js"></script>
        <script src="../asset/js/plugins/jquery.knob.js"></script>
        <script src="../asset/js/plugins/ion.rangeSlider.min.js"></script>
        <script src="../asset/js/plugins/bootstrap-material-datetimepicker.js"></script>
        <script src="../asset/js/plugins/jquery.nicescroll.js"></script>
        <script src="../asset/js/plugins/jquery.mask.min.js"></script>
        <script src="../asset/js/plugins/select2.full.min.js"></script>
        <script src="../asset/js/plugins/nouislider.min.js"></script>
        <script src="../asset/js/plugins/jquery.validate.min.js"></script>



        <div id="content">

        <div class="panel box-shadow-none content-header">
            <div class="panel-body" style="align-content: center">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Alta de Venta</h3>

                </div>
            </div>
        </div>
        <?php if(@$_GET['e']== 'updateGasto1'){ ?>

            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                    <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                        <span class="fa fa-check fa-2x"></span></div>
                    <div class="col-md-10 col-sm-10">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <p><strong>Felicidades!</strong> Se ha dado de alta una nueva venta.</p>
                    </div>
                </div>
            </div>
            <br>
        <?php
        }
        ?>
        <?php if(@$_GET['e']== 'notFull'){ ?>

            <div class="col-md-6 col-md-offset-3">
                <div class="alert col-md-12 col-sm-12 alert-icon alert-danger alert-dismissible fade in" role="alert">
                    <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                        <span class="fa fa-flash fa-2x"></span></div>
                    <div class="col-md-10 col-sm-10">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <p><strong>Error!</strong> Tienes que llenar todos los datos.</p>
                    </div>
                </div>

            </div>
            <br>
        <?php
        }
        ?>
        <div class="col-md-12">
        <div class="col-md-10  padding-0" style="align-content: center">
        <div class="col-md-12">
        <div class="panel">
        <div class="panel-body">
        <div class="col-md-12 padding-0" style="padding-bottom:20px;">
        <?php
        include '../libs/conexion.php';

        $tablaDeMysql = "clientes"; //Define el nombre de la tabla donde estan los datos


        //Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_clientes LIKE '".$_GET['idCliente']."'";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {


            $nombre = $row[1];
            $direccion = $row[2];
            $telefono = $row[3];
        }


        $tablaDeMysql = "ventas"; //Define el nombre de la tabla donde estan los datos


        //Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
        $resultado = $mysqli->query($consulta);

        $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado



        ?>



        <form action="../controllers/updateVenta.php?a=modificaNota&id=<?php echo $_GET['idVenta']; ?>" method="post">
            <div class="col-md-9"></div>
            <div class="col-md-3 form-group ">
                <p>No. nota de venta. <?php $tablaDeMysql = "ventas";


                    $consulta = "SELECT id_ventas FROM ".$tablaDeMysql." WHERE id_ventas LIKE '".$_GET['idVenta']."' ;";
                    $resultado = $mysqli->query($consulta);


                    while ($row=mysqli_fetch_row($resultado))
                    {
                        $idVentas = $row[0];
                    }
                    echo $idVentas;
                    ?></p>
            </div>

            <div class="col-md-9"></div>
            <div class="col-md-3 form-group ">
                <label><span class="fa fa-calendar"></span> Fecha:</label>
                <?php echo date('d-m-Y h:i:s'); ?>
            </div>
            <div class="col-md-12 form-group form-animate-text">
                <input type="text" class="form-text " name="nombre" value="<?php echo $nombre; ?>" required>
                <span class="bar"></span>
                <label><span class="icon-user"></span> Nombre: </label>
            </div>
            <div class="col-md-12 form-group form-animate-text">
                <input type="text" class="form-text " name="direccion" value="<?php echo $direccion; ?>" required>
                <span class="bar"></span>
                <label><span class="fa fa-dot-circle-o"></span> Dirección: </label>
            </div>
            <div class="col-md-6 form-group form-animate-text">
                <input type="tel" class="form-text " name="telefono" value="<?php echo $telefono; ?>" required>
                <span class="bar"></span>
                <label><span class="fa fa-mobile-phone"></span> Telefono:</label>
            </div>
            <div class="col-md-6 form-group form-animate-text">
                <input type="text" class="form-text " name="chofer" required>
                <span class="bar"></span>
                <label><span class="fa fa-truck"></span> Chofer</label>
            </div>
            <?php $tablaDeMysql = "producto_venta";


            $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_ventas LIKE '".$_GET['idVenta']."'";
            $resultado = $mysqli->query($consulta);


            while ($row=mysqli_fetch_row($resultado))
            {



            ?>

            <div class="row">
                <div class="col-md-12" id="insertar">
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text" value="<?php echo $row[3]; ?>" id="cantidad_0" name="cantidad" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-list-ol"></span> Cantidad</label>
                    </div>

                    <div class="col-md-4 form-group form-animate-text">
                        <input type="text" class="form-text " value="<?php echo $row[4]; ?>" readonly="readonly" id="descripcion_0" name="descripcion" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-pencil-square"></span>Descripción</label>
                    </div>

                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " value="<?php echo $row[5]; ?>" id="kilos_0" name="kilos" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-calendar"></span> Kilos</label>
                    </div>
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " value="<?php echo $row[6]; ?>" id="precio_unitario" name="precio_unitario" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-dollar"></span> P. Unitario</label>
                    </div>
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " value="<?php echo $row[7]; ?>" id="importe_0" name="importe" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-dollar"></span> Importe</label>
                    </div>

                </div>



                <br><br>
            </div>

                <?php } ?>
        <?php $tablaDeMysql = "ventas";


        $consulta = "SELECT precio_total FROM ".$tablaDeMysql." WHERE id_ventas LIKE '".$_GET['idVenta']."'";
        $resultado = $mysqli->query($consulta);


        while ($row=mysqli_fetch_row($resultado))
        {



            ?>

            <div class="col-md-2 form-group form-animate-text">
                <input type="text" class="form-text" value="<?php echo $row[0]; ?>" id="total" name="total" required>
                <span class="bar"></span>
                <label><span class="fa fa-dollar"></span>Total</label>
            </div>
            <?php } ?>
        </div>


        <button type="button" onclick="submit()"  class="btn btn-success">Guardar</button>

        </form>

        </div>
        </div>
        </div>
        </div>
        </div>

        </html>


    <?php
    }else{

        SESSION_UNSET();

        SESSION_DESTROY();
        header('Location: ../index.php?e=error1');

    }
}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>
