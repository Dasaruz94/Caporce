<?php
SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <?php
        include 'librerias.php';

        include 'menu.php';

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
                                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                                        <thead>

                                                        <tr>


                                                            <th style="text-align: center;">Cliente</th>
                                                            <th style="text-align: center;">Folio</th>
                                                            <th style="text-align: center;">Chofer</th>
                                                            <th style="text-align: center;">Monto Total</th>
                                                            <th style="text-align: center;">Status de Pago</th>
                                                            <th style="text-align: center;">Fecha de Venta</th>
                                                            <th style="text-align: center;">Tipo de Pago</th>
                                                            <th style="text-align: center;">Pago a Cuenta</th>
                                                            <th style="text-align: center;">Pagar Nota</th>
                                                            <th style="text-align: center;">Editar Nota</th>
                                                            <th style="text-align: center;">Ver PDF</th>
                                                            <th style="text-align: center;">Eliminar</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        include '../libs/conexion.php';


                                                        $consulta = "SELECT * FROM ventas WHERE activo LIKE 1";

                                                        //$consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_clientes IN (SELECT nombre_cliente FROM clientes WHERE id_clientes == id_clientes) AND (SELECT nombre_producto FROM productos_gral WHERE id_productos_gral == id_productos_gral)";
                                                        $resultado = $mysqli->query($consulta);

                                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                        while ($row=mysqli_fetch_row($resultado))
                                                        {
                                                            $id = $row[0];

                                                            $consulta1 = "SELECT * FROM clientes WHERE id_clientes LIKE '".$row[1]."'";
                                                            $resultado1 = $mysqli->query($consulta1);

                                                            while ($row1=mysqli_fetch_row($resultado1))
                                                            {
                                                                $idCliente =$row1[0];
                                                                $nombre = $row1[1];

                                                            }



                                                            ?>
                                                            <tr>

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
                                                                <td style="color: red">

                                                                    <?php if($row[4] == 0){echo 'PAGADO'; }elseif($row[5] == 2){echo 'PAGADO'; }else{?>  <input type="button" class="btn btn-success" onclick="Pregunta5(<?php echo $id;?>)" value="Pago a Cuenta"/>

                                                                    <?php } ?>

                                                                </td>



                                                                <td style="color: red">

                                                                    <?php if($row[5] == 1){?><input type="button" class="btn btn-success" onclick="Pregunta1(<?php echo $id;?>)" value="Pagar Nota"/><?php }else{ echo 'PAGADO';} ?>

                                                                </td>
                                                                <td style="color: red">

                                                                    <input type="button" class="btn btn-success" onclick="Pregunta2(<?php echo $id;?>)" value="Editar Nota"/>

                                                                </td>
                                                                <td>
                                                                    <a  target="_blank" href="../controllers/equiposPdf.php?idCliente=<?php echo $idCliente;?>&idVenta=<?php echo $id; ?>">
                                                                        <span class="fa fa-file-pdf-o" style="font-size: 4em; color: #ff0000"></span>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <button class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning"
                                                                            value="primary" onclick="Pregunta(<?php echo $id;?>)">

                                                                    </button>
                                                                </td>

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <form action="../controllers/updateVenta.php?a=pcuenta&idCliente=<?php echo $idCliente;?>&idVenta=<?php echo $id; ?>" method="post">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">¿Cuanto desea depositar a esta cuenta?</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control" id="monto" name="monto">
                                </div>
                                <div class="modal-footer">
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                <button type="button" onclick="submit()" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
        </div>
        </div>

        <script type="text/javascript">
            function Pregunta1(id){

                if(confirm("¿Es Pago en Efectivo?")){
                    document.location.href="../controllers/updateVenta.php?a=set&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }else{
                    document.location.href="../controllers/updateVenta.php?a=set1&idCliente=<?php echo $_GET['id'];?>&id="+id+"";
                }

            }

            function Pregunta(id){

                if(confirm("¿Estas seguro que desea borrar la nota seleccionada?")){

                    document.location.href="../controllers/updateVenta.php?a=delete&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

                }

            }
            function Pregunta2(id){

                if(confirm("¿Desea Editar Esta Nota?")){
                    document.location.href="../controllers/updateVenta.php?a=updateNota&idCliente=<?php echo $_GET['id'];?>&id="+id+"";

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
        </div>
        </div>
        <script src="../asset/js/plugins/jquery.datatables.min.js"></script>
        <script src="../asset/js/plugins/datatables.bootstrap.min.js"></script>



        <!-- custom -->

        <script type="text/javascript">
            $(document).ready(function(){
                $('#datatables-example').DataTable();
            });
        </script>
        <!-- end: Javascript -->

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