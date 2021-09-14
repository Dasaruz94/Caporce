<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 15/01/16
 * Time: 14:02
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
        <script type="text/javascript">
            function comprobarClave(){
                clave1 = document.form1.password.value
                clave2 = document.form1.password1.value

                if (clave1 == clave2){


                    document.form1.submit();
                }

                else{
                    alert("Las dos claves son distintas, intente de nuevo")
                }

            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#nombre').blur(function(){

                    $('#Info').html('<img src="../asset/img/loader.gif" alt="" />').fadeOut(1000);

                    var nombre = $(this).val();
                    var dataString = 'nombre='+nombre;

                    $.ajax({
                        type: "POST",
                        url: "checkuser.php",
                        data: dataString,
                        success: function(data) {
                            $('#Info').fadeIn(1000).html(data);
                            //alert(data);
                        }
                    });
                });
            });



        </script>

        <?php
        include '../libs/conexion.php';

        $tablaDeMysql = "usuario"; //Define el nombre de la tabla donde estan los datos


        //Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_usuario LIKE '".$_SESSION['id']."'";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {

            $valueTP = $row[3];

            $nombre = $row[1];

            if($row[3] == 1){

                $tipousuario = 'Administrador';
            }
            if($row[3] == 2){
                $tipousuario = 'Ventas';
            }
            if($row[3] == 3){
                $tipousuario = 'Inventario';
            }

        }
        ?>
        <div id="content">

            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Alta de Usuarios</h3>

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
                <div class="col-md-3">
                </div>

                <div class="col-md-6  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">


                                    <form action="../controllers/updateUsuario.php?a=updateS" method="post" name="form1" id="form1">
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="nombre" name="nombre"  value="<?php echo $nombre; ?>" onfocus="if(this.value=='<?php echo $nombre; ?>')this.value=''" required>
                                            <span class="bar"></span>
                                            <label>Usuario</label>
                                            <div id="Info"></div>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="password" class="form-text" id="password" name="password"  value="<?php echo $_SESSION['password']; ?>" onfocus="if(this.value=='<?php echo $_SESSION['password']; ?>')this.value=''" required>
                                            <span class="bar"></span>
                                            <label>Contraseña</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="password" class="form-text" id="password1" name="password1" value="<?php echo $_SESSION['password']; ?>" onfocus="if(this.value=='<?php echo $_SESSION['password']; ?>')this.value=''" required>
                                            <span class="bar"></span>
                                            <label>Verifique su contraseña</label>
                                        </div>
                                        <?php if($_SESSION['tipo_usuario'] == 1){


                                        ?>
                                        <div class="form-group"><label class="col-sm-2 control-label text-right">Tipo de Usuario</label>
                                            <div class="col-sm-4">
                                                <div class="col-sm-12 padding-0">
                                                    <select class="form-control" name="tipo_usuario">
                                                        <option value="<?php echo $valueTP; ?>"><?php echo $tipousuario; ?></option>
                                                        <option></option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Ventas</option>
                                                        <option value="3">Inventario</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }

                                        ?><br><br><br>

                                        <button type="button" onclick="comprobarClave()" class="btn btn-success">Actualizar mis datos</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        </div>
        </html>


    <?php

}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>
