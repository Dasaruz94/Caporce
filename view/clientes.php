<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 22/02/16
 * Time: 10:42
 */

SESSION_START();
if(isset($_SESSION['nombre'])) {

   // if($_SESSION['tipo_usuario'] != 3){

        ?>
        <!DOCTYPE html>
        <html lang="es">

        <?php
        include 'librerias.php';

        include 'menu.php';

        ?>

        <div id="content">

            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Clientes</h3>
                    </div>
                </div>
            </div>
            <?php if(@$_GET['e']== 'updateVenta'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> Se ha dado de alta un nuevo cliente.</p>
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
                <div class="col-md-2">



                </div>
                <div class="col-md-12  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
        <?php if($_SESSION['tipo_usuario'] != 3) {

            ?>
            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                <div class="col-md-6" style="padding-left:10px;">

                    <div class="col-md-3">
                        <a href="../forms/alta_cliente.php">
                            <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                <div class="flip">
                                    <div class="side">
                                        Nuevo Cliente <span class="icon-user-follow"></span>
                                    </div>
                                    <div class="side back">
                                        Agregar Nuevo
                                    </div>

                                </div>
                                <span class="icon"></span>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>

                                <div class="col-md-12 top-20 padding-0">
                                <div class="col-md-12">
                                <div class="panel">
                                <div class="panel-heading"><h3>Clientes CAPORCE</h3></div>
                                <div class="panel-body">
                                <div class="responsive-table">
                                <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>

                                    <tr>

                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
        <?php if($_SESSION['tipo_usuario'] == 1) {


            ?>
                                        <th>Editar Datos</th>
            <?php }?>
                                        <th>Ventas</th>
    <?php if($_SESSION['tipo_usuario'] != 3) {


        ?>
                                        <th>Generar Venta</th>
        <?php }?>
        <?php if($_SESSION['tipo_usuario'] == 1) {


            ?>
            <th>Eliminar</th>
            <?php
        }
            ?>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include '../libs/conexion.php';

                                    $tablaDeMysql = "clientes"; //Define el nombre de la tabla donde estan los datos


                                    //Checamos si se lleno el campo de usuario en el formulario


                                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
                                    $resultado = $mysqli->query($consulta);

                                    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                    while ($row=mysqli_fetch_row($resultado))
                                    {
                                        $id = $row[0];



                                        ?>
                                        <tr>

                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[2]; ?></td>
                                            <td><?php echo $row[3]; ?></td>
                                            <?php if($_SESSION['tipo_usuario'] == 1) {


                                            ?>   <td>
                                                <a href="../forms/actualizaCliente.php?id=<?php echo $row[0]?>">
                                                    <input type="button" class="btn btn-round btn-success" value="Editar Datos">
                                                </a>
                                            </td>
                                            <?php }?>
                                            <td>
                                                <a href="../view/ventas.php?id=<?php echo $row[0]?>">
                                                    <input type="button" class="btn btn-round btn-success" value="Ver Ventas">
                                                </a>
                                            </td>
                                            <?php if($_SESSION['tipo_usuario'] != 3) {


                                            ?>
                                            <td>
                                                <a target="_blank" href="../forms/alta_venta1.php?id=<?php echo $row[0] ?>">
                                                    <input type="button" class="btn btn-round btn-success" value="Vender">
                                                </a>
                                            </td>
                                            <?php
                                            }

                                            ?>
                                            <?php if($_SESSION['tipo_usuario'] == 1){


                                            ?>
                                            <td>
                                                <button class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning"
                                                        value="primary" onclick="Pregunta(<?php echo $row[0]; ?>)">


                                                </button>
                                            </td>
                                            <?php }?>

                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                                    <script type="text/javascript">

                                        function Pregunta(value1){

                                            if(confirm("¿Estas seguro Eliminar este Cliente?")){
                                                document.location.href="../controllers/updateVenta.php?a=borraCliente&id="+value1;

                                            }

                                        }
                                    </script>
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
        <!-- start: Javascript -->



        <!-- plugins -->

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