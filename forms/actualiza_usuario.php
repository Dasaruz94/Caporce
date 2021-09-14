<?php
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


        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE id_usuario LIKE '".$_GET['id']."'";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {


            $nombre = $row[1];
            $password = $row[2];

            if($row[3] == 1){

                $tipousuario = 'Administrador';
            }
            if($row[3] == 2){
                $tipousuario = 'Ventas';
            }
            if($row[3] == 3){
                $tipousuario = 'Inventario';
            }
            if($row[3] == 4){
                $tipousuario = 'Cobranzas';
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
            <div class="col-md-12">
                <div class="col-md-3">
                </div>
                <div class="col-md-6  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">

                                    <form action="../controllers/updateUsuario.php?a=update&id=<?php echo $_GET['id'] ?>" method="post" >
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" onfocus="if(this.value=='<?php echo $nombre; ?>')this.value=''" required>
                                            <span class="bar"></span>
                                            <label>Usuario</label>
                                            <div id="Info"></div>
                                        </div>


                                        <div class="form-group"><label class="col-sm-2 control-label text-right">Tipo de Usuario</label>
                                            <div class="col-sm-4">
                                                <div class="col-sm-12 padding-0">
                                                    <select class="form-control" name="tipo_usuario">
                                                        <option value="<?php echo $row[3] ?>"><?php echo $tipousuario ?></option>
                                                        <option  ></option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Ventas</option>
                                                        <option value="3">Inventario</option>
                                                        <option value="4">Cobranzas</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br><br>

                                        <button type="button" onclick="this.form.submit()" class="btn btn-success">modificar</button>

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

        SESSION_UNSET();

        SESSION_DESTROY();
        header('Location: ../index.php?e=error1');

    }
}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>
