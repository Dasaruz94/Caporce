<?php

SESSION_START();
if(isset($_SESSION['nombre'])) {

    //if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>

        <html lang="en">
        <script src="../asset/js/jquery.min.js"></script>

        <script type="text/javascript">


            function mostrar1(value_elemento1){
                var total = 3; //total de mis capas
                if (value_elemento1 == "1") {
                    $("#labelDateI").hide();
                    $("#inputDateI").hide();
                    $("#divDateI").hide();

                    $("#labelDateF").hide();
                    $("#inputDateF").hide();
                    $("#divDateF").hide();



                }
                if (value_elemento1 == "2") {

                    $("#labelDateI").show();
                    $("#inputDateI").show();
                    $("#divDateI").show();

                    $("#labelDateF").show();
                    $("#inputDateF").show();
                    $("#divDateF").show();

                }
                if (value_elemento1 == "0") {
                    $("#labelDateI").hide();
                    $("#inputDateI").hide();
                    $("#divDateI").hide();

                    $("#labelDateF").hide();
                    $("#inputDateF").hide();
                    $("#divDateF").hide();


                }
            }

        </script>
        <?php
        include '../view/librerias.php';
        include '../view/menu.php';

        ?>

        <div id="content">

            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Creador de reportes</h3>

                    </div>
                </div>
            </div>
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
                <div class="col-md-2">
                </div>

                <div class="col-md-8  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">


                                    <form action="../controllers/updateReporte.php?a=reporte" method="post" name="form1" id="form1">

                                        <div class="form-group col-md-12">
                                            <div class="form-group"><label class="col-sm-2 control-label text-right">Seleciona un Reporte</label>
                                                <div class="col-sm-10">
                                                    <div class="col-sm-12 padding-0">
                                                        <select class="form-control" name="reporte">
                                                            <option value="clientes">Clientes</option>
                                                            <option value="deudas">Deudas</option>
                                                            <option value="historial_compras">Historial compras</option>
                                                            <option value="rotacion_producto">Rotación producto</option>
                                                            <option value="inventario">Inventario</option>
                                                            <option value="gastos">Gastos</option>
                                                            <option value="entradas_salidas">Entradas/Salidas de Caja</option>
                                                            <option value="corte_z">Corte z</option>
                                                            <option value="venta_global">Ventas globales</option>
                                                            <option value="rendimiento">Rendimientos</option>
                                                            <option value="venta_filtro">Ventas filtro</option>


                                                        </select>
                                                    </div>
                                                </div>


                                                <br>


                                                <div class="form-group form-animate-text" style="margin-top:40px !important;">

                                                </div>


                                                <div class="col-sm-12 padding-0">
                                                    <label>Tipo Reporte</label>
                                                    <select class="form-control" name="tipo_reporte" onchange="mostrar1(this.value);">
                                                        <option value="0"></option>
                                                        <option value="1">Todo</option>
                                                        <option value="2">Fechado</option>

                                                    </select>
                                                </div>

                                                <br><br>
                                                <br><br>
                                                <br><br>
                                                <div class="col-md-12 form-group" id="divDateI" style="display: none; margin-top:40px !important;">
                                                    <div class="col-md-6">
                                                        <label style="display: none" id="labelDateI">Fecha inicial</label>
                                                        <input type="date" class="form-text" id="inputDateI" name="fecha_inicio" required>
                                                        <span class="bar"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group" id="divDateF" style="display: none; margin-top:40px !important;">
                                                    <div class="col-md-6">
                                                        <label style="display: none" id="labelDateF">Fecha final</label>
                                                        <input type="date" class="form-text" id="inputDateF" name="fecha_final" required>
                                                        <span class="bar"></span>
                                                    </div>
                                                </div>


                                                <br><br><br><br><br><br>


                                                <button type="button" onclick="submit()"  class="btn btn-success">Crear reporte</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>

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