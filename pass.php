<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 7/04/16
 * Time: 9:41
 */

$b='1234';
$patron='Zn5G7hnkL0bhgf1';
$b=$patron.md5($b);

echo $b;

/*
echo '== Letras ==' . PHP_EOL;

$s = 'A';
echo $s;
//for ($n=0; $n<1; $n++) {
    echo ++$s . PHP_EOL;
//}

include 'libs/conexion.php';

$consulta1 = "SELECT * FROM ventas WHERE activo LIKE 1";
$resultado1 = $mysqli->query($consulta1);

while ($row1=mysqli_fetch_row($resultado1))
{

   $id = $row1[0];


    $folio = 'A-'.$id;

    $sql = 'UPDATE ventas SET folio="'.$folio.'" WHERE id_ventas LIKE "'.$id.'"';

    if (mysqli_query($mysqli, $sql)) {

       echo 'aki compilando ggggggg';
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}
*/


?>