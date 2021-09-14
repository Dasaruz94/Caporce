<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';

if($_GET['tipo'] == 1){


    $consulta = "SELECT V.id_ventas,V.fecha_venta,C.nombre_cliente,PV.cantidad, PV.descripcion, PV.kilos, PV.importe, V.precio_total FROM ventas V INNER JOIN clientes C on V.id_clientes = C.id_clientes INNER JOIN producto_venta PV on V.id_ventas = PV.id_ventas";

}else{
    $consulta = "SELECT V.id_ventas,V.fecha_venta,V.id_clientes,C.nombre_cliente,PV.cantidad, PV.descripcion, PV.kilos, PV.importe, V.precio_total FROM ventas V INNER JOIN clientes C on V.id_clientes = C.id_clientes INNER JOIN producto_venta PV on V.id_ventas = PV.id_ventas WHERE (fecha_venta BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";

}

$resultado = $mysqli->query($consulta);

$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("Caporce");
    $objPHPExcel->getProperties()->setLastModifiedBy("Caporce");
    $objPHPExcel->getProperties()->setTitle("Reporte Ventas Globales Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Ventas Globales");
    $objPHPExcel->getProperties()->setDescription("Reporte Ventas Globales");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Ventas Globales CAPORCE";
    $titulosColumnas = array('No. Nota','Fecha','Hora','Nombre del Cliente', 'Cantidad', 'Descripcion', 'Kilos','Importe','Monto Total');
    //ancho de celdas automatico
    for($i = 'A'; $i <= 'C'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    }



    ob_clean();
    /*Aqui se deben de elegir que campos se pueden mostrar para el usuario*/
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", $tituloReporte);
    $objPHPExcel->getActiveSheet()->SetCellValue("A2", $titulosColumnas[0]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B2", $titulosColumnas[1]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C2", $titulosColumnas[2]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D2", $titulosColumnas[3]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E2", $titulosColumnas[4]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F2", $titulosColumnas[5]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G2", $titulosColumnas[6]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H2", $titulosColumnas[7]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I2", $titulosColumnas[8]);

    $i = 1;
$idVenta = 0;
    while ($fila = mysqli_fetch_array($resultado)) {



        if($idVenta != $fila['id_ventas']){

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_ventas']);
            $fecha = explode(" ", $fila['fecha_venta']);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fecha[0]);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fecha[1]);
            $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['nombre_cliente']);
            $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['cantidad']);
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['descripcion']);
            $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['kilos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $fila['importe']);
            $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, $fila['precio_total']);

            $idVenta = $fila['id_ventas'];
        }else{

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_ventas']);
            $fecha = explode(" ", $fila['fecha_venta']);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fecha[0]);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fecha[1]);
            $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['nombre_cliente']);
            $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['cantidad']);
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['descripcion']);
            $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['kilos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $fila['importe']);
            $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, '');
        }

        /*$objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_ventas']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['nombre_cliente']);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['descripcion']);
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['kilos']);
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['importe']);
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['precio_total']); */

        $counter++;
        $i++;
    }
    // ob_start();



//otros dispositivos



    $estiloTituloReporte = array(
        'font' => array(
            'name'      => 'Arial',
            'bold'      => true,
            'italic'    => false,
            'strike'    => false,
            'size' =>13,
            'color'     => array(
                'rgb' => 'FFFFFF'
            )
        ),
        'fill' => array(
            'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
            'color'	=> array(
                'argb' => 'FF220835')
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation' => 0,
            'wrap' => TRUE
        )
    );




//forma sencilla de dar estilos
    $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
    // $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:M".($counter-1));

    $nombreArchivo = "ReporteVentasGlobales". date('d-m-Y');

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=$nombreArchivo.xls");
    header("Content-Transfer-Encoding: binary ");

    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save('php://output');


}

?>