<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';

if($_GET['tipo'] == 1){


    $consulta = "SELECT * FROM producto_venta ORDER BY descripcion";

}else{
    $consulta = "SELECT * FROM producto_venta WHERE (fecha_creacion BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')ORDER BY descripcion";

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

    if($_GET['tipo'] == 1){

        $tituloReporte = "Reporte De Todos Los Productos Vendidos CAPORCE";


    }else{
        $tituloReporte = "Reporte De Todos Los Productos Vendidos CAPORCE Entre ".$_GET['fI']." Y ".$_GET['fF']."";
    }

    $titulosColumnas = array('Producto','piezas vendidas', 'Kilos totales');
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

    $i = 1;
    $producto = '';
    $pasa = true;
    $cantidad = 0;
    $kilos = 0;
    while ($fila = mysqli_fetch_array($resultado)) {

        $str = strtolower(@$fila['descripcion']);

if($pasa){
    $producto = $str;
}

        if($producto == $str){


            $cantidad = $cantidad + $fila['cantidad'];
            $kilos = $kilos + $fila['kilos'];

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $str);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $cantidad);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $kilos);


            $pasa = false;
        }else{

            $counter++;

            $cantidad = 0;
            $kilos = 0;

            $cantidad = $cantidad + $fila['cantidad'];
            $kilos = $kilos + $fila['kilos'];

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $str);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $cantidad);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $kilos);

            $producto = $str;

        }




        $i++;
    }




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

    $nombreArchivo = "ReporteProductos". date('d-m-Y');

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