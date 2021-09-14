<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 25/01/16
 * Time: 10:42
 */

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
                    <h3 class="animated fadeInLeft">Productos Derivados</h3>
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
            <?php }?>
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

        <div class="col-md-12">
            <div class="col-md-2">
                <a href="../controllers/updateInventarioDerivados.php?a=actualizar">
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
            </div>
            <div class="col-md-8  padding-0" style="align-content: center">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                                <div class="col-md-12">
                                    <div class="panel box-v2">

                                        <div class="panel-heading padding-0">
                                            <img src="../asset/img/img_inventario2.jpg" class="box-v2-cover img-responsive"/>
                                            <div class="box-v2-detail">
                                                <img src="../asset/img/icon_inventario.jpg" class="img-responsive"/>
                                                <h4>Almacen 2 fecha: <?php echo date('Y-m-d'); ?></h4>
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                            <?php
                                            include '../libs/conexion.php';

                                            $tablaDeMysql = "derivados"; //Define el nombre de la tabla donde estan los datos


                                            //Checamos si se lleno el campo de usuario en el formulario


                                            $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND almacen LIKE 1 AND fecha = '".date('Y-m-d')."' ";
                                            $resultado = $mysqli->query($consulta);



                                            // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                            $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

                                            ?>

                                            <div class="col-md-12 padding-0 text-center">
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['mascara_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=mascara_peso" style="color: white;"> Mascara</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['lengua_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=lengua_peso" style="color: white;"> Lengua</a>

                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                                    <h3><?php echo $row['sesos_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=sesos_peso" style="color: white;"> Cesos</a>

                                                </div>

                                            </div>

                                            <div class="col-md-12 padding-0 text-center">

                                                <hr size="10" style="color: #0056b2;" />
                                            </div>

                                            <div class="col-md-12 padding-0 text-center">
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['hueso_cabeza_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=hueso_cabeza_peso" style="color: white;"> Hueso de Cabeza</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['papada_cabeza_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=papada_cabeza_peso" style="color: white;"> Papada de Cabeza</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['recorte_cabeza_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=recorte_cabeza_peso" style="color: white;"> Recorte de Cabeza</a>
                                                </div>

                                            </div>

                                            <div class="col-md-12 padding-0 text-center">

                                                <hr size="10" style="color: #0056b2;" />
                                            </div>

                                            <div class="col-md-12 padding-0 text-center">
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['manteca_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=manteca_peso" style="color: white;"> Manteca</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['prensado_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=prensado_peso" style="color: white;"> Prensado</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['sancocho_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=sancocho_peso" style="color: white;"> Sancocho</a>
                                                </div>

                                            </div>

                                            <div class="col-md-12 padding-0 text-center">

                                                <hr size="10" style="color: #0056b2;" />
                                            </div>

                                            <div class="col-md-12 padding-0 text-center">
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['chicharron_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=chicharron_peso" style="color: white;"> Chicharron</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['ahumada_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=ahumada_peso" style="color: white;"> Ahumada</a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                    <h3><?php echo $row['tocino_peso'].' Kilos';?></h3>
                                                    <span class="fa fa-pencil-square-o"></span> <a href="../forms/actualiza_inventario_derivados.php?p=tocino_peso" style="color: white;"> Tocino</a>
                                                </div>

                                            </div>

                                            <div class="col-md-12 padding-0 text-center">

                                                <hr size="10" style="color: #0056b2;" />
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

}
?>
