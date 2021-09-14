<?php

SESSION_START();
if(isset($_SESSION['nombre'])) {

 //   if($_SESSION['tipo_usuario']== 1){

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
                        <h3 class="animated fadeInLeft">Compras</h3>
                    </div>
                </div>
            </div>
            <?php if(@$_GET['a']== 'updateGasto1'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> Se ha insertado una nueva Compra con exito.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>

            <?php if(@$_GET['a']== 'deleted'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> La compra ha sido Eliminada.</p>
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
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                    <div class="col-md-6" style="padding-left:10px;">


                                        <div class="col-md-3">
                                            <a href="../forms/alta_compra_pieza.php">
                                                <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                                    <div class="flip">
                                                        <div class="side">
                                                            Compra productos <span class="icon-user-follow"></span>
                                                        </div>
                                                        <div class="side back">
                                                            Agregar Nuevo
                                                        </div>

                                                    </div>
                                                    <span class="icon"></span>
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <a href="../controllers/deudaExcel.php">
                                                <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                                    <div class="flip">
                                                        <div class="side">
                                                            Reporte de Compras <span class="icon-user-follow"></span>
                                                        </div>
                                                        <div class="side back">
                                                            Excel
                                                        </div>

                                                    </div>
                                                    <span class="icon"></span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12 top-20 padding-0">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading"><h3>Compras CAPORCE</h3></div>
                                            <div class="panel-body">
                                                <div class="responsive-table">
                                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                                        <thead>

                                                        <tr>



                                                            <th>Descripciòn</th>
                                                            <th>Proveedor</th>
                                                            <th>Precio Total</th>
                                                            <th>Status de Pago</th>
                                                            <th>Fecha de Compra</th>
                                                            <th>Fecha de Pago</th>
                                                            <th>Dias de Credito</th>
                                                            <th>Tipo de Pago</th>
                                                            <th>Pagar Compra</th>
                                                            <th>Eliminar</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        include '../libs/conexion.php';

                                                        $tablaDeMysql = "compras"; //Define el nombre de la tabla donde estan los datos


                                                        //Checamos si se lleno el campo de usuario en el formulario

                                                        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 ORDER BY fecha_compra DESC";
                                                        //$consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_clientes IN (SELECT nombre_cliente FROM clientes WHERE id_clientes == id_clientes) AND (SELECT nombre_producto FROM productos_gral WHERE id_productos_gral == id_productos_gral)";
                                                        $resultado = $mysqli->query($consulta);

                                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                        while ($row=mysqli_fetch_row($resultado))
                                                        {
                                                            $id = $row[0];



                                                            ?>
                                                            <tr>

                                                                <td><?php if($row[1] == null){echo 'Compra de Productos';}?></td>
                                                                <td><?php echo $row[2]; ?></td>
                                                                <td><?php echo $row[3]; ?></td>
                                                                <td><?php if($row[4] == 1){echo 'Credito';}else{echo 'Pagado';} ?></td>
                                                                <td><?php echo $row[5]; ?></td>
                                                                <td><?php echo $row[6]; ?></td>


                                                                <td>
                                                                    <?php
                                                                    if($row[4] == 2){echo 'PAGADO';}else{
                                                                    $datetime1 = new DateTime(date('Y-m-d h:i:s'));
                                                                    $datetime2 = new DateTime($row[7]);
                                                                    $interval = date_diff($datetime1, $datetime2);
                                                                    echo $interval->format('%R%a días');
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td><?php if($row[8] == 1){echo 'Efectivo';}elseif($row[8] == 2){echo 'Deposito';}elseif($row[8] == null){echo 'En credito';}?></td>
                                                                <td style="color: red">

                                                                   <?php if($row[4] == 1){ ?> <input type="button" class="btn btn-success" onclick="Pagar(<?php echo $row[0];?>)" value="Pagar Compra"/> <?php }else{echo 'PAGADO';}?>

                                                                </td>
                                                                <td>
                                                                    <button class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning"
                                                                            value="primary" onclick="Pregunta(<?php echo $row[0]; ?>)">


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

                <script type="text/javascript">

                    function Pregunta(value1){

                        if(confirm("¿Estas seguro que desea borrar la Venta seleccionada?")){
                            document.location.href="../controllers/updateCompra.php?e=delete&id="+value1;

                        }

                    }
                    function Pagar(value){

                        if(confirm("¿Estas seguro que desea Pagar la Compra seleccionada?")){
                            document.location.href="../controllers/updateCompra.php?a=pagarCompra&id="+value;

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
        </html>

    <?php
  /*  }else{

        SESSION_UNSET();

        SESSION_DESTROY();
        header('Location: ../index.php?e=error1');

    } */
}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>

