<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';

if($_GET['tipo'] == 1){


$consulta = "SELECT ventas.folio, clientes.nombre_cliente,ventas.chofer, ventas.precio_total, ventas.fecha_venta FROM ventas INNER JOIN clientes on ventas.id_clientes = clientes.id_clientes WHERE  status_pago LIKE 1 ORDER BY nombre_cliente asc ,fecha_venta asc";
}else{
    $consulta = "SELECT ventas.folio, clientes.nombre_cliente,ventas.chofer, ventas.precio_total, ventas.fecha_venta FROM ventas INNER JOIN clientes on ventas.id_clientes = clientes.id_clientes WHERE (fecha_venta BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."') AND status_pago LIKE 1 ORDER BY nombre_cliente asc ,fecha_venta asc";

}

$resultado = $mysqli->query($consulta);

$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("Caporce");
    $objPHPExcel->getProperties()->setLastModifiedBy("Caporce");
    $objPHPExcel->getProperties()->setTitle("Reporte Deuda por cliente Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Deuda por cliente");
    $objPHPExcel->getProperties()->setDescription("Reporte Deudas");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Deuda de Cliente de CAPORCE";
    $titulosColumnas = array('No. Nota','Nombre', 'Chofer', 'Monto total', 'Fecha de Venta');
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

    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {

        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['folio']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['nombre_cliente']);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['chofer']);
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['precio_total']);
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['fecha_venta']);

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

    $nombreArchivo = "ReporteClientesDeuda". date('d-m-Y');

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