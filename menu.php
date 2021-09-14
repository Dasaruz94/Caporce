<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>-
                <span class="bottom"></span>
            </div>
            <a href="inicio.php" class="navbar-brand">
                <span>SISTEMA CAPORCE V1</span>
            </a>
            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?php echo $_SESSION['nombre'];?></span></li>
                <li class="dropdown avatar-dropdown">
                    <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="true"/>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="forms/actualiza_Uactual.php"><span class="fa fa-user"></span> Mis datos</a></li>

                        <li role="separator" class="divider"></li>
                        <li class="more">
                            <ul>

                                <li><a href="logout.php"><span class="fa fa-power-off "></span>Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li>
                <div class="left-bg"></div>
            </li>
            <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>

                <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>


            <li class="active ripple">
                <a class="tree-toggle nav-header"><span class="fa-home fa"></span> Control
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="forms/formReportes.php">Reportes</a></li>
                    <?php if($_SESSION['tipo_usuario'] == 1){
                    ?>
                    <li><a href="view/usuarios.php">Usuarios</a></li>
                    <li><a href="view/ventas1.php">Todas las ventas</a></li>
                    <?php } ?>
                </ul>
            </li>

            <li class="active ripple">
                <a class="tree-toggle nav-header"><span class="fa fa-archive"></span> Inventario
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="view/inventario.php">Productos</a></li>

                </ul>
            </li>
            <?php if($_SESSION['tipo_usuario'] == 1 or $_SESSION['tipo_usuario'] == 4){


            ?>
            <li class="active ripple">
                <a class="tree-toggle nav-header"><span class="fa fa-archive"></span> Compras
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="view/compras.php">Compras</a></li>
                    <li><a href="view/gastos.php">Gastos</a></li>
                </ul>
            </li>

            <?php
            }

            ?>

            <li class="ripple"><a href="view/clientes.php"><span class="icon-people"></span>Clientes</a></li>


            <?php if($_SESSION['tipo_usuario'] == 1 or $_SESSION['tipo_usuario'] == 4){


            ?>
            <li class="ripple"><a href="view/caja.php"><span class="fa fa-calendar-o"></span>Caja</a></li>

            <?php
            }

            ?>
        </ul>
    </div>
</div>


<script src="asset/js/jquery.min.js"></script>

<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>

<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/fullcalendar.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>
<script src="asset/js/plugins/jquery.vmap.min.js"></script>
<script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
<script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
<script src="asset/js/plugins/chart.min.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript"></script>