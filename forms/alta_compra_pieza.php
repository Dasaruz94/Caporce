<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 19/02/16
 * Time: 9:53
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>
        <html lang="es">

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
                    <h3 class="animated fadeInLeft">Compra de Piezas</h3>

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
                        <p><strong>Felicidades!</strong> Se ha dado de alta una nueva venta.</p>
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
        <div class="col-md-10  padding-0" style="align-content: center">
        <div class="col-md-12">
        <div class="panel">
        <div class="panel-body">
        <div class="col-md-12 padding-0" style="padding-bottom:20px;">
        <?php
        include '../libs/conexion.php';





        ?>
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


        <script type="text/javascript">
            var counter = 1;
            var total = 0;
            var contador1 = 0;
            var limit = 10;
            var contador = 1;
            var valor = 0;
            var precio = 0;
            var importe = 0;


            function addInput(divName){
                if (counter == limit)
                {
                    alert("No puedes agregar más de " + counter + " productos");
                }
                else
                {
                    var newdiv = document.createElement('div');
                    newdiv.innerHTML = '<div class="col-md-2 form-group form-animate-text">' +
                        ' <input type="text" class="form-text " id="cantidad_'+contador+'" name="cantidad_'+contador+'" required>' +
                        '<span class="bar"></span>' +
                        '<label><span class="fa fa-list-ol"></span> Cantidad</label>' +
                        ' </div>' +
                        '' +
                        ' <div class="col-md-4 form-group form-animate-text">' +
                        ' <input type="text" class="form-text " id="descripcion_'+contador+'" name="descripcion_'+contador+'" required>' +
                        '<span class="bar"></span>' +
                        '<label><span class="fa fa-pencil-square"></span> Descripción</label>' +
                        ' </div>' +
                        '' +
                        '<div class="col-md-2 form-group form-animate-text">' +
                        '<input type="text" class="form-text " id="kilos_'+contador+'" name="kilos_'+contador+'" required>' +
                        '<span class="bar"></span>' +
                        '<label><span class="fa fa-calendar"></span> Kilos</label>' +
                        '</div>' +
                        '' +
                        '<div class="col-md-2 form-group form-animate-text">' +
                        '<input type="text" class="form-text " id="precio_unitario_'+contador+'" name="precio_unitario_'+contador+'" required>' +
                        '<span class="bar"></span>' +
                        '<label><span class="fa fa-dollar"></span> P. Unitario</label>' +
                        '</div>' +
                        '' +
                        '<div class="col-md-2 form-group form-animate-text">' +
                        '<input type="text" class="form-text " id="importe_'+contador+'" name="importe_'+contador+'" required>' +
                        '<span class="bar"></span>' +
                        '<label><span class="fa fa-dollar"></span> Importe</label>' +
                        '</div>';



                    //newdiv.innerHTML = "<br><input type='text' name='dia_"+contador+"'>";
                    document.getElementById(divName).appendChild(newdiv);
                    counter++;
                    contador++;
                }
            }


            function Operaciones(){



                while(contador1 <= counter){



                    cadena =  document.getElementById("descripcion_"+contador1+"").value;

                    cadena = cadena.toLowerCase();


                    if(cadena == "cabeza" || cadena == "varilla"){

                        valor = document.getElementById("cantidad_"+contador1+"").value;
                        precio = document.getElementById("precio_unitario_"+contador1+"").value;

                        importe = valor * precio;
                        document.getElementById("importe_"+contador1+"").value = importe;

                        total = total + importe;
                        contador1 ++;

                        document.getElementById("total").value = total;

                    }
                    else{

                        valor = document.getElementById("kilos_"+contador1+"").value;
                        precio = document.getElementById("precio_unitario_"+contador1+"").value;

                        importe = valor * precio;
                        document.getElementById("importe_"+contador1+"").value = importe;

                        total = total + importe;
                        contador1 ++;

                        document.getElementById("total").value = total;

                    }

                    /* if(cadena == "cabeza" || cadena == "varilla"){

                     valor = document.getElementById("cantidad_"+contador1+"").value;
                     precio = document.getElementById("precio_unitario_"+contador1+"").value;

                     importe = valor * precio;
                     document.getElementById("importe_"+contador1+"").value = importe;

                     total = total + importe;
                     contador1 ++;

                     document.getElementById("total").value = total;

                     }
                     else{

                     valor = document.getElementById("kilos_"+contador1+"").value;
                     precio = document.getElementById("precio_unitario_"+contador1+"").value;

                     importe = valor * precio;
                     document.getElementById("importe_"+contador1+"").value = importe;

                     total = total + importe;
                     contador1 ++;

                     document.getElementById("total").value = total;

                     }  */


                }


            }




        </script>


        <form action="../controllers/updateCompra.php?a=add" method="post">
            <div class="col-md-9"></div>
            <div class="col-md-3 form-group ">

            </div>

            <div class="col-md-9"></div>
            <div class="col-md-3 form-group ">
                <label><span class="fa fa-calendar"></span> Fecha:</label>
                <?php echo date('d-m-Y h:i:s'); ?>
            </div>
            <div class="col-md-12 form-group form-animate-text">
                <input type="text" class="form-text " name="proveedor" required>
                <span class="bar"></span>
                <label><span class="icon-user"></span> Proveedor: </label>
            </div>



            <div class="row">
                <div class="col-md-12" id="insertar">
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text" id="cantidad_0" name="cantidad_0" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-list-ol"></span> Cantidad</label>
                    </div>

                    <div class="col-md-4 form-group form-animate-text">
                        <input type="text" class="form-text " id="descripcion_0" name="descripcion_0" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-pencil-square"></span>Descripción</label>
                    </div>

                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " id="kilos_0" name="kilos_0" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-calendar"></span> Kilos</label>
                    </div>
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " id="precio_unitario_0" name="precio_unitario_0" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-dollar"></span> P. Unitario</label>
                    </div>
                    <div class="col-md-2 form-group form-animate-text">
                        <input type="text" class="form-text " id="importe_0" name="importe_0" required>
                        <span class="bar"></span>
                        <label><span class="fa fa-dollar"></span> Importe</label>
                    </div>

                </div>


                <div class="col-md-10">
                    <button type="button" class="btn btn-success" onClick="addInput('insertar');">Agregar otro producto</button>
                    <button type="button" onclick="Operaciones()" class="btn btn-alert">Obtener total</button>
                </div>
                <div class="col-md-2 form-group form-animate-text">
                    <input type="text" class="form-text" id="total" name="total" required>
                    <span class="bar"></span>
                    <label><span class="fa fa-dollar"></span> Total</label>
                </div>


                <br><br>
            </div>


        </div>



        <div class="row">
            <div class="col-sm-4"></div>
        <div class="col-sm-4 padding-0">
            <label>Status de pago</label>
            <select class="form-control" name="status_pago" onchange="mostrar1(this.value);">
                <option value="0"></option>
                <option value="1">Credito</option>
                <option value="2">Pagado</option>

            </select>
        </div>

        <br><br>
        <br><br>
            <br>


        <div class="col-md-3 form-group" id="divDate" style="display: none; margin-top:40px !important;">
            <div class="col-md-3">
                <label style="display: none" id="labelDate">Fecha de credito</label>
                <input type="date" class="form-text" id="inputDate" name="fecha_credito" required>
                <span class="bar"></span>
            </div>
        </div>
            <div class="col-sm-4"></div>
        <div class="col-sm-3 padding-0" id="divTP" style="display: none;">
            <label style="display: none" id="labelTP">Tipo de pago</label>
            <select class="form-control" name="tipo_pago" id="selectTP" style="display: none;">
                <option value="0"></option>
                <option value="1">Efectivo</option>
                <option value="2">Deposito</option>

            </select>
        </div>
            </div>
        <br><br>
        <br><br>
        <br><br>
        <button type="button" onclick="submit()"  class="btn btn-success">Dar de Alta</button>
        </form>

        </div>
        </div>
        </div>
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
