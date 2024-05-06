<?php

SESSION_START();
if(isset($_SESSION['nombre'])) {

  //  if($_SESSION['tipo_usuario']!= 3){

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">

        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/simple-line-icons.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/mediaelementplayer.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="../asset/css/plugins/icheck/skins/flat/red.css"/>
        <link href="../asset/css/style.css" rel="stylesheet">
        <?php
        include '../libs/conexion.php';

        include 'librerias.php';

        include 'menu.php';

        $consulta = "SELECT * FROM ventas WHERE activo LIKE 1 AND id_clientes LIKE '".$_GET['id']."' ORDER BY id_ventas DESC";

        //$consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_clientes IN (SELECT nombre_cliente FROM clientes WHERE id_clientes == id_clientes) AND (SELECT nombre_producto FROM productos_gral WHERE id_productos_gral == id_productos_gral)";
        $resultado1 = $mysqli->query($consulta);

        $total = mysqli_num_rows($resultado1); //Contamos la cantidad de filas que nos arrojo el resultado

        ?>

        <div id="content">

            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Ventas</h3>
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
                            <p><strong>Felicidades!</strong> Se ha insertado un nuevo gasto con exito.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>

            <?php if(@$_GET['e']== 'deleted'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> El Gasto ha sido borrado.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>
            <div class="col-md-12">

                <div class="col-md-12  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">

                                <div class="col-md-12 top-20 padding-0">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading"><h3>Ventas CAPORCE</h3></div>
                                            <div class="panel-body">
                                                <div class="responsive-table">
                                                    <form method="post">
                                                      <?php if($_SESSION['tipo_usuario'] == 1 or $_SESSION['tipo_usuario'] == 4){
                                                          ?>
                                                        <input type="button" class="btn btn-success" onclick="this.form.action='../controllers/updateVenta.php?a=vp&idCliente=<?php echo $_GET['id'];?>&i=<?php echo $total; ?>';this.form.submit();" value="Pagar en efectivo"/>
                                                        <input type="button" class="btn btn-success" onclick="this.form.action='../controllers/updateVenta.php?a=vp1&idCliente=<?php echo $_GET['id'];?>&i=<?php echo $total; ?>';this.form.submit();" value="Pagar en deposito"/>
                                                      <?php }?>
                                                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                                        <thead>

                                                        <tr>

                                                            <th style="text-align: center;"></th>
                                                            <th style="text-align: center;">Cliente</th>
                                                            <th style="text-align: center;">Folio</th>
                                                            <th style="text-align: center;">Chofer</th>
                                                            <th style="text-align: center;">Monto Total</th>
                                                            <th style="text-align: center;">Status de Pago</th>
                                                            <th style="text-align: center;">Fecha de Venta</th>
                                                            <th style="text-align: center;">Tipo de Pago</th>
                                                            <?php if($_SESSION['tipo_usuario'] != 3) {


                                                                ?>
                                                            <th style="text-align: center;">Pago a Cuenta</th>

                                                            <th style="text-align: center;">Editar Nota</th>
                                                            <?php } ?>
                                                            <th style="text-align: center;">Ver PDF</th>
    <?php if($_SESSION['tipo_usuario'] == 1) {


        ?>
                                                            <th style="text-align: center;">Ultima Modificacion</th>
                                                            <th style="text-align: center;">Por Pagar</th>
        <?php }?>
                                                            <?php if($_SESSION['tipo_usuario'] != 3) {


                                                                ?>
                                                            <th style="text-align: center;">Eliminar</th>
                                                            <?php }?>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php


                                                        $tablaDeMysql = "clientes"; //Define el nombre de la tabla donde estan los datos

                                                        //Checamos si se lleno el campo de usuario en el formulario

                                                        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_clientes LIKE '".$_GET['id']."'";
                                                        $resultado = $mysqli->query($consulta);

                                                        while ($row=mysqli_fetch_row($resultado))
                                                        {
                                                            $nombre = $row[1];

                                                        }

                                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

                                                        // $tablaDeMysql = "ventas"; //Define el nombre de la tabla donde estan los datos


                                                        //Checamos si se lleno el campo de usuario en el formulario

                                                        //$consulta = "SELECT ventas.id_ventas,clientes.nombre_cliente,ventas.chofer,ventas.status_pago,ventas.precio_total,ventas.fecha_venta,ventas.tipo_pago FROM ventas INNER JOIN clientes on ventas.id_clientes = clientes.id_clientes WHERE ventas.id_cliente LIKE ".$_GET['id']." ";


                                                        $i = 0;
                                                        while ($row=mysqli_fetch_row($resultado1))
                                                        {
                                                            $id = $row[0];

                                                           ?>


                                                            <tr>
                                                                <td><input type="checkbox" class="icheck" name="id_[<?php echo $i; ?>]" value="<?php echo $row[0]; ?>" /></td>
                                                                <td><?php echo $nombre; ?></td>
                                                                <td><?php echo $row[2]; ?></td>
                                                                <td><?php echo $row[3]; ?></td>
                                                                <td>
                                                                    <?php $numero = $row[4];
                                                                      echo '$'.number_format($numero,2); ?>
                                                                </td>
                                                                <td><?php if($row[5] == 1){echo 'Credito';}else{echo 'Pagado';} ?></td>
                                                                <td><?php echo $row[6]; ?></td>
                                                                <td><?php if($row[7] == 1){echo 'Efectivo';}elseif($row[7] == 2){echo 'Deposito';}elseif($row[7] == 3){echo 'En credito';} ?></td>
                                                                <?php if($_SESSION['tipo_usuario'] != 3) {


                                                                    ?>
                                                            <td style="color: red">

                                                                    <?php if($row[4] == 0){echo 'PAGADO'; }elseif($row[5] == 2){echo 'PAGADO'; }else{?>  <input type="button" class="btn btn-success" onclick="Pregunta5(<?php echo $id;?>)" value="Pago a Cuenta"/>

                                                                    <?php } ?>

                                                                </td>


                                                                <td>
                                                                    <input type="button" class="btn btn-success" onclick="Pregunta2(<?php echo $id;?>)" value="Editar Nota"/>

                                                                </td>
                                                                <?php } ?>
                                                                <td>
                                                                    <a  target="_blank" href="../controllers/equiposPdf.php?idCliente=<?php echo $_GET['id'];?>&idVenta=<?php echo $id; ?>">
                                                                        <span class="fa fa-file-pdf-o" style="font-size: 4em; color: #ff0000"></span>
                                                                    </a>
                                                                </td>
                                                                <?php if($_SESSION['tipo_usuario'] == 1) {


                                                                ?>
                                                                <td>
                                                                    <?php

                                                                    $consultaNueva = "SELECT * FROM usuario WHERE id_usuario LIKE ".$row[9];
                                                                    $resultadoNuevo = $mysqli->query($consultaNueva);

                                                                    while ($clienteInfo=mysqli_fetch_row($resultadoNuevo))
                                                                    {
                                                                        $nombrePersna = $clienteInfo[1];

                                                                    }

                                                                    echo $nombrePersna;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <input type="button" class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning" onclick="Pregunta4(<?php echo $id;?>)" value="PP"/>

                                                                </td>
                                                                <?php }?>
                                                                <?php if($_SESSION['tipo_usuario'] != 3) {


                                                                ?>
                                                                <td>

                                                                    <input type="button" class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning" onclick="Pregunta3(<?php echo $id;?>)" value="X"/>

                                                                </td>
                                                                <?php } ?>

                                                            </tr>
                                                        <?php
                                                            $i++;
                                                        }
                                                        ?>

                                                        </tbody>
                                </table>
        <?php if($_SESSION['tipo_usuario'] == 1 or $_SESSION['tipo_usuario'] == 4){
            ?>
                                                        <input type="button" class="btn btn-success" onclick="this.form.action='../controllers/updateVenta.php?a=vp&idCliente=<?php echo $_GET['id'];?>&i=<?php echo $total; ?>';this.form.submit();" value="Pagar en efectivo"/>
                                                        <input type="button" class="btn btn-success" onclick="this.form.action='../controllers/updateVenta.php?a=vp1&idCliente=<?php echo $_GET['id'];?>&i=<?php echo $total; ?>';this.form.submit();" value="Pagar en deposito"/>
<?php  } ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">

            function Pregunta3(id){


                if(confirm("¿Estas seguro que desea borrar la nota seleccionada?")){

                    document.location.href="../controllers/updateVenta.php?a=delete&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }else{

                }

            }
            function Pregunta2(id){

                if(confirm("¿Desea Editar Esta Nota?")){
                    document.location.href="../controllers/updateVenta.php?a=updateNota&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }else{

                }

            }

            function Pregunta4(id){

                if(confirm("¿Desea poner status por pagar en esta nota?")){
                    document.location.href="../controllers/updateVenta.php?a=ppNota&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }else{

                }

            }
            function Pregunta5(id){

                if(confirm("¿Desea abonar a cuenta?")){
                    document.location.href="../forms/pago_cuenta.php?idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }else{

                }

            }

        </script>
        <script src="../asset/js/plugins/jquery.datatables.min.js"></script>
        <script src="../asset/js/plugins/datatables.bootstrap.min.js"></script>


        <script src="../asset/js/plugins/icheck.min.js"></script>
        <!-- custom -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#datatables-example').DataTable();
            });
        </script>
        <!-- end: Javascript -->

        </html>

    <?php
   /* }else{

        SESSION_UNSET();

        SESSION_DESTROY();
        header('Location: ../index.php?e=error1');

    } */
}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>