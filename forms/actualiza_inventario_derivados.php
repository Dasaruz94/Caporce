<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 25/01/16
 * Time: 11:01
 */

SESSION_START();
if(isset($_SESSION['nombre'])) {

    if($_SESSION['tipo_usuario']== 1){


        include '../libs/conexion.php';

        $tablaDeMysql = "derivados"; //Define el nombre de la tabla donde estan los datos


//Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT " .$_GET['p']. " FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND fecha = '".date('Y-m-d')."' ";
        $resultado = $mysqli->query($consulta);



// $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {
            $cantidad = $row[0];

        }



        $kilo  = $_GET['p'];
        $kilo1 = explode("_", $kilo);

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <?php
        include '../view/librerias.php';
        include '../view/menu.php';

        ?>
        <div id="content">

            <div class="panel box-shadow-none content-header">
                <div class="panel-body" style="align-content: center">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Modificar cantidad de <?php echo $kilo1[0].' Actualmente:'.$cantidad.' En inventario'; ?> </h3>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                </div>

                <div class="col-md-4  padding-0" style="align-content: center">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-12 padding-0" style="padding-bottom:20px;">



                                    <form action="../controllers/updateInventarioDerivados.php?a=updateUno&p=<?php echo $_GET['p']; ?>" name="form1" id="form1" method="post">
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="nombre" name="pieza_kilos" required>
                                            <span class="bar"></span>
                                            <label>Kilos</label>
                                            <div id="Info"></div>
                                        </div>

                                        <br>

                                        <button type="button" onclick="submit()" class="btn btn-success">Modificar</button>

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
