<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22/01/16
 * Time: 14:55
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'reporte'){


    if($_POST['reporte'] == "clientes"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: clientesExcel.php?tipo=1');
        }else{
            header('Location: clientesExcel.php?tipo=1');
        }


    }

    if($_POST['reporte'] == "corte_z"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: corteZExcel.php?tipo=1');
        }else{
            header('Location: corteZExcel.php?tipo=1');
        }


    }

        if($_POST['reporte'] == "deudas"){

            if($_POST['tipo_reporte'] == 1){
                header('Location: deudaExcel.php?tipo=1');
            }else{
                header('Location: deudaExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
            }


        }

    if($_POST['reporte'] == "inventario"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: inventarioExcel.php');
        }else{
            header('Location: inventarioExcel.php');
        }


    }
    if($_POST['reporte'] == "venta_global"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: ventasExcel.php?tipo=1');
        }else{
            header('Location: ventasExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }

    if($_POST['reporte'] == "venta_filtro"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: ventasPiezaExcel.php?tipo=1');
        }else{
            header('Location: ventasPiezaExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }

    if($_POST['reporte'] == "historial_compras"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: comprasExcel.php?tipo=1');
        }else{
            header('Location: comprasExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }
    if($_POST['reporte'] == "gastos"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: gastosExcel.php?tipo=1');
        }else{
            header('Location: gastosExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }
    if($_POST['reporte'] == "entradas_salidas"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: entrada-salidaExcel.php?tipo=1');
        }else{
            header('Location: entrada-salidaExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }

    if($_POST['reporte'] == "rotacion_producto"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: rProductoExcel.php?tipo=1');
        }else{
            header('Location: rProductoExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
            }


    }
    if($_POST['reporte'] == "rendimiento"){

        if($_POST['tipo_reporte'] == 1){
            header('Location: rendimientoExcel.php?tipo=1');
        }else{
            header('Location: rendimientoExcel.php?tipo=2&fI='.$_POST['fecha_inicio'].'&fF='.$_POST['fecha_final']);
        }


    }




}

