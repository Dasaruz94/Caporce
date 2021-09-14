<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';

if($_GET['tipo'] == 1){


    $consulta = "SELECT C.id_compras,C.fecha_compra,C.proveedor,PC.num_productos, PC.descripcion, PC.kilos FROM compras C  INNER JOIN producto_compra PC on C.id_compras = PC.id_compras";
    $consulta1 = "SELECT V.id_ventas,V.fecha_venta,C.nombre_cliente,PV.cantidad, PV.descripcion, PV.kilos FROM ventas V INNER JOIN clientes C on V.id_clientes = C.id_clientes INNER JOIN producto_venta PV on V.id_ventas = PV.id_ventas";


}else{
    $consulta = "SELECT C.id_compras,C.fecha_compra,C.proveedor,PC.num_productos, PC.descripcion, PC.kilos FROM compras C  INNER JOIN producto_compra PC on C.id_compras = PC.id_compras WHERE (fecha_compra BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";
    $consulta1 = "SELECT V.id_ventas,V.fecha_venta,C.nombre_cliente,PV.cantidad, PV.descripcion, PV.kilos FROM ventas V INNER JOIN clientes C on V.id_clientes = C.id_clientes INNER JOIN producto_venta PV on V.id_ventas = PV.id_ventas WHERE (fecha_venta BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";

}

$resultado = $mysqli->query($consulta);
$resultado1 = $mysqli->query($consulta1);

$total = mysqli_num_rows($resultado,$resultado1); //Contamos la cantidad de filas que nos arrojo el resultado



if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("Caporce");
    $objPHPExcel->getProperties()->setLastModifiedBy("Caporce");
    $objPHPExcel->getProperties()->setTitle("Reporte Rendimiento Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Rendimiento");
    $objPHPExcel->getProperties()->setDescription("Reporte Rendimiento");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "RENDIMIENTOS CAPORCE";
    $titulosColumnas = array('Folio compra','Fecha de compra','Proveedor', 'Numero de Producto','Descripcion','Kilos', 'Folio Venta','fecha de venta','Nombre de Cliente','Cantidad','Descripcion','Kilos');
    //ancho de celdas automatico
    for($i = 'A'; $i <= 'M'; $i++){
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
    $objPHPExcel->getActiveSheet()->SetCellValue("H2", $titulosColumnas[6]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I2", $titulosColumnas[7]);
    $objPHPExcel->getActiveSheet()->SetCellValue("J2", $titulosColumnas[8]);
    $objPHPExcel->getActiveSheet()->SetCellValue("K2", $titulosColumnas[9]);
    $objPHPExcel->getActiveSheet()->SetCellValue("L2", $titulosColumnas[10]);
    $objPHPExcel->getActiveSheet()->SetCellValue("M2", $titulosColumnas[11]);



    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {





        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_compras']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['fecha_compra']);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['proveedor']);

        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['num_productos']);
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['descripcion']);
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['kilos']);

        $counter++;
        $i++;
    }
    $i = 1;

    while ($fila1 = mysqli_fetch_array($resultado1)) {






        $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $fila1['id_ventas']);
        $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, $fila1['fecha_venta']);
        $objPHPExcel->getActiveSheet()->SetCellValue("J" . $counter, $fila1['nombre_cliente']);
        $objPHPExcel->getActiveSheet()->SetCellValue("K" . $counter, $fila1['cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("L" . $counter, $fila1['descripcion']);
        $objPHPExcel->getActiveSheet()->SetCellValue("M" . $counter, $fila1['kilos']);

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

    $nombreArchivo = "ReporteRendimientos". date('d-m-Y');

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