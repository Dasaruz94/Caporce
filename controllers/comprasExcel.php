<?php

ob_start();

date_default_timezone_set('America/Mexico_City');

include '../libs/conexion.php';

if($_GET['tipo'] == 1){


    $consulta = "SELECT C.id_compras,C.fecha_compra,C.proveedor,PC.num_productos, PC.descripcion, PC.kilos,PC.precio_unitario, PC.importe, C.precio_total FROM compras C  INNER JOIN producto_compra PC on C.id_compras = PC.id_compras";

}else{
    $consulta = "SELECT C.id_compras,C.fecha_compra,C.proveedor,PC.num_productos, PC.descripcion, PC.kilos,PC.precio_unitario, PC.importe, C.precio_total FROM compras C  INNER JOIN producto_compra PC on C.id_compras = PC.id_compras WHERE (fecha_compra BETWEEN '".$_GET['fI']."' AND '".$_GET['fF']."')";

}

$resultado = $mysqli->query($consulta);

$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("Caporce");
    $objPHPExcel->getProperties()->setLastModifiedBy("Caporce");
    $objPHPExcel->getProperties()->setTitle("Reporte Historial Compras Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Historial Compras");
    $objPHPExcel->getProperties()->setDescription("Reporte Historial Compras");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Historial Compras CAPORCE";
    $titulosColumnas = array('Folio Compra','Fecha de Compra','Proveedor', 'Cantidad', 'Descripcion', 'Kilos','Precio Unitario','Importe','Monto Total');
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
    $objPHPExcel->getActiveSheet()->SetCellValue("E2", $titulosColumnas[4]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F2", $titulosColumnas[5]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G2", $titulosColumnas[6]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H2", $titulosColumnas[7]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I2", $titulosColumnas[8]);

    $i = 1;
    $idCompra = 0;
    while ($fila = mysqli_fetch_array($resultado)) {



        if($idCompra != $fila['id_compras']){

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $fila['id_compras']);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['fecha_compra']);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['proveedor']);
            $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['num_productos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['descripcion']);
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['kilos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['precio_unitario']);
            $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $fila['importe']);
            $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, $fila['precio_total']);

            $idCompra = $fila['id_compras'];
        }else{

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, '');
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, '');
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, '');
            $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $fila['num_productos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['descripcion']);
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['kilos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['precio_unitario']);
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

    $nombreArchivo = "ReporteHistorialCompras". date('d-m-Y');

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