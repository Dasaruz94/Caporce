<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';

if($_GET['tipo'] == 1){


    $consulta = "SELECT id_ingresos,fecha_ingreso,descripcion,precio FROM ingresos ";
    $consulta1 = "SELECT id_gastos, fecha_pago,descripcion, precio FROM gastos";


}else{
    $consulta = "SELECT id_ingresos,fecha_ingreso,descripcion,precio FROM ingresos  WHERE (fecha_ingreso BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";
    $consulta1 = "SELECT id_gastos, fecha_pago,descripcion, precio FROM gastos  WHERE (fecha_pago BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";

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
    $objPHPExcel->getProperties()->setTitle("Reporte Entradas/Salidas Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Entradas/Salidas");
    $objPHPExcel->getProperties()->setDescription("Reporte Entradas/Salidas");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Entradas/Salidas de Caja CAPORCE";
    $titulosColumnas = array('Folio Ingreso','Fecha de ingreso','Descripcion', 'Monto', 'Folio de Gasto', 'Fecha de Gasto','Descripcion','Monto');
    //ancho de celdas automatico
    for($i = 'A'; $i <= 'H'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    }



    ob_clean();
    /*Aqui se deben de elegir que campos se pueden mostrar para el usuario*/
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", $tituloReporte);
    $objPHPExcel->getActiveSheet()->SetCellValue("A2", $titulosColumnas[0]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B2", $titulosColumnas[1]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C2", $titulosColumnas[2]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D2", $titulosColumnas[3]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F2", $titulosColumnas[4]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G2", $titulosColumnas[5]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H2", $titulosColumnas[6]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I2", $titulosColumnas[7]);


    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {





        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_ingresos']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['fecha_ingreso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['descripcion']);

        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['precio']);

        $counter++;
        $i++;
    }
    $i = 1;

    while ($fila1 = mysqli_fetch_array($resultado1)) {






        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila1['id_gastos']);
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila1['fecha_pago']);
        $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $fila1['descripcion']);

        $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, $fila1['precio']);

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

    $nombreArchivo = "ReporteEntradas/SalidasCaja". date('d-m-Y');

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