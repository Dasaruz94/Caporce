<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 28/01/16
 * Time: 11:11
 */
SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>
        <html lang="en">

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
                        <h3 class="animated fadeInLeft">Piezas disponibles</h3>

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
                            <p><strong>Felicidades!</strong> Se ha dado de alta un nuevo gasto.</p>
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
                <div class="col-md-1">
                </div>


                <?php
                    include '../libs/conexion.php';

                    $tablaDeMysql = "inventario"; //Define el nombre de la tabla donde estan los datos


                    //Checamos si se lleno el campo de usuario en el formulario


                    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1";
                    $resultado = $mysqli->query($consulta);

                ?>

                <div class="col-md-10  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                    <form action="../controllers/updateInventario.php?a=combinacion" method="post">
                                        <div class="col-md-12 form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text"  name="descripcion" required>
                                            <span class="bar"></span>
                                            <label>Nombre de la Combinacion</label>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label text-right"></label>
                                        <?php
                                        $count = 1;

                                        while ($row=mysqli_fetch_row($resultado))
                                        {
                                        $id = $row[0];

                                        if($count == 3){

                                            $count = 1;
                                            ?>
                                            <div class="col-md-3" style="border: 2px">
                                                <div class="col-sm-12 padding-0">
                                                    <input type="checkbox" value="<?php echo $row[0]; ?>" name="pieza[<?php echo $row[0]; ?>]"> <?php echo $row[1];?><br>
                                                    Peso<input type="double" class="form-text"  name="peso_<?php echo $row[1];?>" required>
                                                    Cantidad<input type="double"  class="form-text"  name="cantidad_<?php echo $row[1];?>" required>
                                                </div>
                                        </div>
<br><br>
                                        <div class="form-group"><label class="col-sm-2 control-label text-right"></label>

                                            <?php
                                        }else{
                                                ?>
                                            <div class="col-md-3">
                                                <div class="col-sm-12 padding-0">
                                                    <input type="checkbox" value="<?php echo $row[0]; ?>" name="pieza[<?php echo $row[0]; ?>]"> <?php echo $row[1];?><br>
                                                    Peso<input type="double"  class="form-text"  name="peso_<?php echo $row[1];?>" required>
                                                    Cantidad<input type="double"  class="form-text"  name="cantidad_<?php echo $row[1];?>" required>
                                                </div>
                                            </div>
                                            <?php

                                                $count ++;
                                            }

?>


                                        <?php } ?>






                                    </div>

                                    </form>
                                    <button type="button" onclick="submit()"  class="btn btn-success">Dar de Alta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
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
