<?php

SESSION_START();
if(isset($_SESSION['nombre'])) {

    $total=2;


}else{

    include 'libs/conexion.php';


    $tablaDeMysql = "usuario"; //Define el nombre de la tabla donde estan los datos


//Checamos si se lleno el campo de usuario en el formulario
    $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);


    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE username LIKE '".$_POST['username']."' AND password LIKE '".$b."' AND activo LIKE 1 ";
    $resultado = $mysqli->query($consulta);

    $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


}



if($total == 1){




    $_SESSION['nombre']=$_POST['username'];




    while ($row=mysqli_fetch_row($resultado))
    {

        $_SESSION['id'] = $row[0];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['tipo_usuario'] = $row[3];

    }


    $total=2;
}

if($total==2){

?>

<!DOCTYPE html>
<html lang="en">
    <title>Gracias por nacer Sam</title>

<?php include 'librerias.php';

include 'menu.php';
?>

<body id="mimin" class="dashboard" style="background-image: url('asset/img/caporceinicio-01.jpg'); background-size: cover; background-attachment: fixed;">
<!-- start: Header -->

<!-- end: Header -->

<div class="container-fluid mimin-wrapper">

<!-- start:Left Menu -->

<!-- end: Left Menu -->


<!-- start: content -->
  



</div>

<!-- end: content -->



<!-- start: Javascript -->

<!-- end: Javascript -->
</body>
</html>
<?php

}else{

    header('Location: index.php?e=wrong');
}

    ?>