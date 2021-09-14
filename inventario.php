<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22/01/16
 * Time: 12:37
 */

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']!= 1){

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
                        <h3 class="animated fadeInLeft">Productos</h3>
                    </div>
                </div>
            </div>
            <?php if(@$_GET['e']== 'updateU'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> El inventario ha modificado una existencia.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>

            <?php if(@$_GET['e']== 'updateUT'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Felicidades!</strong> El inventario se ha actualizado al dia de hoy.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>

            <?php if(@$_GET['e']== 'error'){ ?>

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>Error!</strong> No existe el producto en el inventario.</p>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>
            <div class="col-md-12">
                <div class="col-md-2">

                        <a href="../controllers/updateInventario.php?a=actualizar">
                            <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                <div class="flip">
                                    <div class="side">
                                        Actualizar <span class="icon-user-follow"></span>
                                    </div>
                                    <div class="side back">
                                        Actualizar
                                    </div>

                                </div>
                                <span class="icon"></span>
                            </button>
                        </a>
                    <br><br>
        <?php if($_SESSION['tipo_usuario'] == 1){


            ?>
                    <a href="../forms/alta_producto.php">
                        <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                            <div class="flip">
                                <div class="side">
                                    Nuevo Producto <span class="icon-user-follow"></span>
                                </div>
                                <div class="side back">
                                    Nuevo
                                </div>

                            </div>
                            <span class="icon"></span>
                        </button>
                    </a>
        <?php
        }

        ?>
                    <br><br>
                    <?php if($_SESSION['tipo_usuario'] == 1){


                    ?>
                    <a href="combinacion.php">
                        <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                            <div class="flip">
                                <div class="side">
                                    Combinaciones <span class="icon-user-follow"></span>
                                </div>
                                <div class="side back">
                                   Ver
                                </div>

                            </div>
                            <span class="icon"></span>
                        </button>
                    </a>
                    <?php
                    }

                    ?>

                </div>



                <div class="col-md-8  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                    <div class="col-md-12">
                                        <div class="panel box-v2">

                                            <div class="panel-heading padding-0">
                                                <img src="../asset/img/img_inventario.jpg" class="box-v2-cover img-responsive"/>
                                                <div class="box-v2-detail">
                                                    <img src="../asset/img/icon_inventario.jpg" class="img-responsive"/>
                                                    <h4>Almacen 1 fecha: <?php echo date('Y-m-d'); ?></h4>
                                                </div>
                                            </div>
                                            <div class="panel-body">

                                                <div class="col-md-12 padding-0 text-center">
                                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                        <h3>Producto</h3>

                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                        <h3>Kilos</h3>

                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                                        <h3>Cantidad en Piezas</h3>



                                                    </div>

                                                </div>
                                                <div class="col-md-12 padding-0 text-center">

                                                    <hr size="10" style="color: #0056b2;" />
                                                </div>
                                                <?php
                                                include '../libs/conexion.php';

                                                $tablaDeMysql = "inventario"; //Define el nombre de la tabla donde estan los datos


                                                //Checamos si se lleno el campo de usuario en el formulario


                                                $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND fecha = '".date('Y-m-d')."' ";
                                                $resultado = $mysqli->query($consulta);



                                                while ($row=mysqli_fetch_row($resultado))
                                                {
                                                $id = $row[0];
                                                ?>

                                                <div class="col-md-12 padding-0 text-center">
                                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                        <h3><?php echo $row[1]; ?></h3>

                                                   </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                        <h3><?php echo $row[2];?> Kilos</h3>

                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                                        <h3><?php echo $row[3];?> Piezas</h3>

                                                        <?php if($_SESSION['tipo_usuario'] == 1){


                                                        ?>
                                                        <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario.php?idPieza=<?php echo $row[0];?>" style="color: white;"><?php echo $row[1];?></a>
                                                        <?php
                                                        }

                                                        ?>

                                                    </div>

                                                </div>

                                                <div class="col-md-12 padding-0 text-center">

                                                    <hr size="10" style="color: #0056b2;" />
                                                </div>

                                                <?php }?>


                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>

                <div class="col-md-2"></div>
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
