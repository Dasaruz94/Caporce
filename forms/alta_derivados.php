<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 12/02/16
 * Time: 11:29
 */

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>

        <html lang="en">
        <script src="../asset/js/jquery.min.js"></script>

        <script type="text/javascript">

            function mostrar(value_elemento){
                var total = 3; //total de mis capas
                if (value_elemento == "2") {
                    $("#labelDesc").show();
                    $("#inputDesc").show();
                    $("#divDesc").show();

                }
                if (value_elemento == "1") {
                    $("#labelDesc").hide();
                    $("#inputDesc").hide();
                    $("#divDesc").hide();



                }
                if (value_elemento == "0") {
                    $("#labelDesc").hide();
                    $("#inputDesc").hide();
                    $("#divDesc").hide();

                }
            }

            function mostrar1(value_elemento1){
                var total = 3; //total de mis capas
                if (value_elemento1 == "1") {
                    $("#labelTP").hide();
                    $("#selectTP").hide();
                    $("#divTP").hide();

                    $("#labelDate").show();
                    $("#inputDate").show();
                    $("#divDate").show();

                }
                if (value_elemento1 == "2") {

                    $("#labelDate").hide();
                    $("#inputDate").hide();
                    $("#divDate").hide();

                    $("#labelTP").show();
                    $("#selectTP").show();
                    $("#divTP").show();

                }
                if (value_elemento1 == "0") {
                    $("#labelTP").hide();
                    $("#selectTP").hide();
                    $("#divDesc").hide();

                    $("#labelDate").hide();
                    $("#inputDate").hide();
                    $("#divDate").hide();

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
                        <h3 class="animated fadeInLeft">Alta de Compra de Productos Derivados</h3>

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


                                    <form action="../controllers/updateCompra.php?a=add2" method="post" name="form1" id="form1">

                                        <div class="form-group col-md-12">
                                            <div class="form-group"><label class="col-sm-2 control-label text-right">Seleciona un Producto</label>
                                                <div class="col-sm-10">
                                                    <div class="col-sm-12 padding-0">
                                                        <select class="form-control" name="descripcion">
                                                            <option value="clientes">Clientes</option>
                                                            <option value="mascara_peso">Mascara</option>
                                                            <option value="lengua_peso">Lengua</option>
                                                            <option value="sesos_peso">Sesos</option>
                                                            <option value="hueso_cabeza_peso">Hueso de Cabeza</option>
                                                            <option value="papada_cabeza_peso">Papada de Cabeza</option>
                                                            <option value="recorte_cabeza_peso">Recorte de Cabeza</option>
                                                            <option value="manteca_peso">Manteca</option>
                                                            <option value="prensado_peso">Prensado</option>
                                                            <option value="sancocho_peso">Sancocho</option>
                                                            <option value="chicharron_peso">Chicharron</option>
                                                            <option value="ahumada_peso">Chuleta Ahumada</option>
                                                            <option value="tocino_peso">Tocino</option>


                                                        </select>
                                                    </div>
                                                </div>


                                            <br>

                                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                                <input type="text" class="form-text" id="proveedor" name="proveedor" required>
                                                <span class="bar"></span>
                                                <label>Proveedor</label>
                                                <div id="Info"></div>
                                            </div>

                                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                                <input type="number" class="form-text" id="num_productos" name="num_productos" required>
                                                <span class="bar"></span>
                                                <label>Numero de Productos</label>
                                            </div>

                                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                                <input type="text" class="form-text" id="kilos" name="kilos" required>
                                                <span class="bar"></span>
                                                <label>Kilos</label>
                                            </div>
                                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                                <input type="text" class="form-text" id="precio_kilos" name="precio_kilos" required>
                                                <span class="bar"></span>
                                                <label>Precio por kilo</label>
                                            </div>
                                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                                <input type="text" class="form-text" id="precio_total" name="precio_total" required>
                                                <span class="bar"></span>
                                                <label>Precio Total</label>
                                            </div>


                                            <div class="col-sm-12 padding-0">
                                                <label>Status de pago</label>
                                                <select class="form-control" name="status_pago" onchange="mostrar1(this.value);">
                                                    <option value="0"></option>
                                                    <option value="1">Credito</option>
                                                    <option value="2">Pagado</option>

                                                </select>
                                            </div>

                                            <br><br>
                                            <br><br>
                                            <br><br>
                                            <div class="col-md-12 form-group" id="divDate" style="display: none; margin-top:40px !important;">
                                                <div class="col-md-6">
                                                    <label style="display: none" id="labelDate">Fecha de credito</label>
                                                    <input type="date" class="form-text" id="inputDate" name="fecha_credito" required>
                                                    <span class="bar"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 padding-0" id="divTP" style="display: none;">
                                                <label style="display: none" id="labelTP">Tipo de pago</label>
                                                <select class="form-control" name="tipo_pago" id="selectTP" style="display: none;">
                                                    <option value="0"></option>
                                                    <option value="1">Efectivo</option>
                                                    <option value="2">Deposito</option>

                                                </select>
                                            </div>
                                            <br><br><br><br><br><br>


                                            <button type="button" onclick="submit()"  class="btn btn-success">Dar de Alta</button>

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