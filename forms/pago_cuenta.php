<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 28/01/16
 * Time: 11:11
 */
SESSION_START();
if(isset($_SESSION['nombre'])) {



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
                        <h3 class="animated fadeInLeft">Alta de Gastos</h3>

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
                <div class="col-md-3">
                </div>

                <div class="col-md-6  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                    <form action="../controllers/updateVenta.php?a=pcuenta&idCliente=<?php echo $_GET['idCliente'];?>&idVenta=<?php echo $_GET['id'];?>" method="post">

                                        <div class=" form-group">

                                            <?php
                                            $_GET['id'];
                                            $_GET['idCliente'];
                                            ?>
                                            <label></span>Cuanto Desea Abonar a esta Nota</label><br>

                                        </div>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="number" class="form-text"  name="monto" required>
                                            <span class="bar"></span>
                                            <label>Monto</label>
                                        </div>

                                        <br><br><br>

                                        <button type="button" onclick="submit()"  class="btn btn-success">Dar de Alta</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>

        </html>


    <?php

}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>
