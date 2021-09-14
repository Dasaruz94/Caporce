<?php
SESSION_START();
if(isset($_SESSION['nombre'])) {

    SESSION_UNSET();
    SESSION_DESTROY();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="description" content="Miminium Admin Template v.1">
    <meta name="author" content="Isna Nur Azis">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caporce</title>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="asset/css/style.css"/>

    <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
    <link href="asset/css/style.css" rel="stylesheet">
    <!-- end: Css -->

    <link rel="shortcut icon" href="asset/img/iconocircular.png">


    <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

<div class="container">
    <?php if(@$_GET['e']== 'wrong1'){ ?>

        <div class="col-md-6 col-md-offset-3">
            <div class="alert col-md-12 col-sm-12 alert-icon alert-danger alert-dismissible fade in" role="alert">
                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                    <span class="fa fa-flash fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong>Error!</strong> No tienes permisos para acceder a esta funcion, contacta a un administrador.</p>
                </div>
            </div>

        </div>
        <br>
    <?php
        //todo ver que pedo
    }
    ?>

<?php if(@$_GET['e']== 'wrong'){ ?>

    <div class="col-md-6 col-md-offset-3">
        <div class="alert col-md-12 col-sm-12 alert-icon alert-danger alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-flash fa-2x"></span></div>
            <div class="col-md-10 col-sm-10">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <p><strong>Error!</strong> Contraseña incorrecta, verifica tus datos.</p>
            </div>
        </div>

    </div>
    <br>
<?php
}
?>
 <?php if(@$_GET['e']== 'logout'){ ?>

    <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
            <div class="col-md-10 col-sm-10">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <p><strong>Hasta Luego!</strong> Su Sesión ha sido cerrada con exito.</p>
            </div>
        </div>
    </div>
     <br>
    <?php
        }
    ?>

    <form class="form-signin" action="inicio.php" method="post">
        <div class="panel periodic-login">

            <div class="panel-body text-center">
                <h1 class="atomic-symbol"><img src="asset/img/iconocircular.png"></h1>
                <p class="atomic-mass">v1.0</p>
                <p class="element-name">Iniciar Sesion</p>

                <i class="icons icon-arrow-down"></i>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="username" class="form-text" required>
                    <span class="bar"></span>
                    <label>Nombre de usuario</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" name="password" class="form-text" required>
                    <span class="bar"></span>
                    <label>Contraseña</label>
                </div>

                <input type="submit" class="btn col-md-12" value="Iniciar sesion"/>
            </div>

        </div>
    </form>

</div>

<!-- end: Content -->
<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>

<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/icheck.min.js"></script>

<!-- custom -->
<script src="asset/js/main.js"></script>

<!-- end: Javascript -->
</body>
</html>
