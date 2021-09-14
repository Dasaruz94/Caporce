<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 15/04/16
 * Time: 11:58
 */

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

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
                        <h3 class="animated fadeInLeft">Combinaciones</h3>
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
                            <p><strong>Felicidades!</strong> La combinacion ha sido eliminada.</p>
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
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                    <div class="col-md-6" style="padding-left:10px;">

                                        <div class="col-md-3">
                                            <a href="../forms/alta_combinacion.php">
                                                <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                                    <div class="flip">
                                                        <div class="side">
                                                            Nueva combinacion <span class="icon-user-follow"></span>
                                                        </div>
                                                        <div class="side back">
                                                            Agregar Nueva
                                                        </div>

                                                    </div>
                                                    <span class="icon"></span>
                                                </button>
                                            </a>
                                        </div>

                                    </div>


                                <div class="col-md-12 top-20 padding-0">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading"><h3>Combinaciones CAPORCE</h3></div>
                                            <div class="panel-body">
                                                <div class="responsive-table">
                                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                                        <thead>

                                                        <tr>

                                                            <th>Nombre</th>
                                                            <!--<th>Ver productos</th>
                                                            <th>Eliminar</th>-->


                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        include '../libs/conexion.php';

                                                        $tablaDeMysql = "combinacion"; //Define el nombre de la tabla donde estan los datos


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

                                                                <!--  <td>
                                                                    <a target="_blank" href="../forms/alta_venta1.php?id=<?php //echo $row[0] ?>">
                                                                        <input type="button" class="btn btn-round btn-success" value="Ver productos">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <button class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning"
                                                                            value="primary" onclick="Pregunta(<?php //echo $row[0]; ?>)">


                                                                    </button>
                                                                </td> -->

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                    </table>
                                                    <script type="text/javascript">

                                                        function Pregunta(value1){

                                                            if(confirm("¿Estas seguro de Eliminar esta Combinacion?")){
                                                                document.location.href="../controllers/updateinventario.php?e=borraCombinacion&id="+value1;

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