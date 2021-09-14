<?php

ob_start();


date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';


//Checamos si se lleno el campo de usuario en el formulario
$consulta1= "SELECT MAX(id_inventario) FROM inventario";
$resultado1 = $mysqli->query($consulta1);

// $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
while ($row1=mysqli_fetch_row($resultado1))
{
    $idInventario = $row1[0];
}

$consulta = "SELECT * FROM inventario WHERE id_inventario LIKE '".$idInventario."'";

$resultado = $mysqli->query($consulta);

$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("Caporce");
    $objPHPExcel->getProperties()->setLastModifiedBy("Caporce");
    $objPHPExcel->getProperties()->setTitle("Reporte Inventario Caporce");
    $objPHPExcel->getProperties()->setSubject("Reporte Inventario");
    $objPHPExcel->getProperties()->setDescription("Reporte Inventario");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Reporte de Inventario";
    $titulosColumnas = array('Almacen','Pierna en Cantidad', 'Pierna en Kilos', 'Costilla en Cantidad', 'Costilla en Kilos','Lomo en Cantidad','Lomo en Kilos','Espinazo en Cantidad','Espinazo en Kilos','Barriga en Cantidad','Barriga en Kilos','Cuero en Cantidad','Cuero en Kilos','Patas en Cantidad','Patas en Kilos','Hueso en Kilos','Papada en Kilos','Grasa en Kilos','Cabezas en Cantidad','Cabezas en Kilos','Varillas en Cantidad','Rabo en cantidad','Rabo en Kilos','Chamorro en Cantidad','Chamorro en Kilos', 'Cabeza de Lomo en Cantidad','Cabeza de Lomo en Kilos');
    //ancho de celdas automatico
    for($i = 'A'; $i <= 'C'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    }



    ob_clean();
    /*Aqui se deben de elegir que campos se pueden mostrar para el usuario*/
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", $tituloReporte);
    $objPHPExcel->getActiveSheet()->SetCellValue("A3", $titulosColumnas[0]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A4", $titulosColumnas[1]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A5", $titulosColumnas[2]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A6", $titulosColumnas[3]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A7", $titulosColumnas[4]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A8", $titulosColumnas[5]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A9", $titulosColumnas[6]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A10", $titulosColumnas[7]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A11", $titulosColumnas[8]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A12", $titulosColumnas[9]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A13", $titulosColumnas[10]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A14", $titulosColumnas[11]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A15", $titulosColumnas[12]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A16", $titulosColumnas[13]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A17", $titulosColumnas[14]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A18", $titulosColumnas[15]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A19", $titulosColumnas[16]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A20", $titulosColumnas[17]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A21", $titulosColumnas[18]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A22", $titulosColumnas[19]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A23", $titulosColumnas[20]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A24", $titulosColumnas[21]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A25", $titulosColumnas[22]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A26", $titulosColumnas[23]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A27", $titulosColumnas[24]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A28", $titulosColumnas[25]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A29", $titulosColumnas[26]);


    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {


        $objPHPExcel->getActiveSheet()->SetCellValue("B3" , $fila['almacen']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B4" , $fila['pierna_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B5" , $fila['pierna_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B6" , $fila['costilla_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B7" , $fila['costilla_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B8" , $fila['lomo_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B9" , $fila['lomo_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B10", $fila['espinazo_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B11", $fila['espinazo_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B12", $fila['barriga_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B13", $fila['barriga_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B14", $fila['cuero_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B15", $fila['cuero_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B16", $fila['pata_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B17", $fila['pata_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B18", $fila['hueso_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B19", $fila['papada_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B20", $fila['grasa_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B21", $fila['cabeza_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B22", $fila['cabeza_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B23", $fila['varilla_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B24", $fila['rabo_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B25", $fila['rabo_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B26", $fila['chamorro_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B27", $fila['chamorro_peso']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B28", $fila['clomo_cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B29", $fila['clomo_peso']);


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
                'rgb' => 'FFFFFF')
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
    $objPHPExcel->getActiveSheet()->getStyle('A2:B1')->applyFromArray($estiloTituloReporte);
    // $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:M".($counter-1));

    $nombreArchivo = "ReporteInventario". date('d-m-Y');

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