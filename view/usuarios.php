<?php
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
                <h3 class="animated fadeInLeft">Usuarios</h3>
            </div>
        </div>
    </div>
    <?php if(@$_GET['e']== 'update'){ ?>

        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                    <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong>Felicidades!</strong> El usuario se ha configurado con exito.</p>
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
                    <p><strong>Felicidades!</strong> El usuario ha sido borrado.</p>
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
                            <div class="col-md-6" style="padding-left:10px;">

                                <div class="col-md-3">
                                   <a href="../forms/alta_usuario.php">
                                    <button class="btn-flip btn btn-gradient btn-primary" onclick="">
                                        <div class="flip">
                                            <div class="side">
                                                Nuevo <span class="icon-user-follow"></span>
                                            </div>
                                            <div class="side back">
                                                Agregar Nuevo
                                            </div>

                                        </div>
                                        <span class="icon"></span>
                                    </button>
                                       </a>
                                </div>
                            </div>

                        </div>
                        <div class="responsive-table">

                            <table class="table table-striped table-bordered " width="100%" cellspacing="0">
                                <thead

                                <tr>

                                    <th>Nombre</th>
                                    <th>tipo de usuario</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>

                                </tr>
                                </thead>
                                <tbody>
    <?php
                include '../libs/conexion.php';

                $tablaDeMysql = "usuario"; //Define el nombre de la tabla donde estan los datos


                //Checamos si se lleno el campo de usuario en el formulario


                $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 ";
                $resultado = $mysqli->query($consulta);

               // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                while ($row=mysqli_fetch_row($resultado))
                {
                    $id = $row[0];

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


                    ?>
                                <tr>

                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $tipousuario; ?></td>
                                    <td>
                                        <button class="tamano_btn icon-pencil center-icon btn btn-circle btn-outline btn-sm btn-primary "
                                                value="primary" onclick="location='../forms/actualiza_usuario.php?&id=<?php echo $row[0] ?>'">

                                        </button>
                                    </td>
                                    <td>
                                        <button class="icon-close center-icon btn btn-circle btn-outline btn-sm btn-warning"
                                                value="primary" onclick="Pregunta(<?php echo $row[0] ?>)">

                                        </button>
                                    </td>

                                </tr>
<?php
                }
                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
        <script type="text/javascript">

            function Pregunta(id){


                if(confirm("¿Estas seguro que deseas borrar al usuario?")){
                    document.location.href="../controllers/updateUsuario.php?a=delete&id="+id;

                }

            }
        </script>
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
