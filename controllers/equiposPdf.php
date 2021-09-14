<?php

ob_start();


?>
<style>
.plogo{
    position: absolute;
    top: -30px;
    right: 300px;
    width: 20px;
    height: 10px
}
.ptext{
    position: absolute;
    top: 90px;
    right: 220px;
    width: 300px;
    height: 10px
}
.ptext1{
     position: absolute;
     top: 102px;
     right: 170px;
     width: 300px;
     height: 10px
 }
.ptext2{
    position: absolute;
    top: 115px;
    right: 145px;
    width: 300px;
    height: 10px
}
table{
   border-collapse: collapse;
    border-radius: 10px;


}
td{
    border: #000000;
    color: #000000;
    height: 15px;
    vertical-align: middle;
    text-align: center;

}
th{
    border: #000000;
    background: gray;

}
.rojo{
    color: red;

}
.table-position{
    position: absolute;
    top: 30px;
    right: 140px;
    width: 20px;
    height: 10px;
    color: white;
    text-align: center;

}
.table-position1{
    position: absolute;
    top: 80px;
    right: 140px;
    width: 20px;
    height: 10px;
    text-align: center;
    color: #ffffff;


}
.div_border{
    border-radius: 10px;
    border: 2px solid;
}
.div_chofer{
    position: absolute;
    top: 220px;
    right: 200px;
    width: 60px;
    height: 10px;

}
.ancho_cant{
    width: 10%;
    text-align: center;
    height: 30px;
    vertical-align: middle;
}
.ancho_desc{
    width: 40%;
    text-align: center;
    vertical-align: middle;
}
.ancho_kilos{
    width: 15%;
    text-align: center;
    vertical-align: middle;
}
.ancho_punit{
    width: 15%;
    text-align: center;
    vertical-align: middle;
}
.ancho_impor{
    width: 20%;
    text-align: center;
    vertical-align: middle;
}
.table-position2{
    position: absolute;
    top: 670px;
    right: 175px;
    width: 20px;
    height: 10px;
}
.nota{
    height: 20px;
    width: 130px;

}

.ptext_clau{
    position: absolute;
    top: 650px;
    right: 220px;
    width: 300px;
    height: 10px
}
.ptext_acepto{
    position: absolute;
    top: 700px;
    right: 350px;

}

</style>

<?php
$i = 1;
 ?>
    <page>

            <div class="plogo"><img src="../asset/img/logopdf.png" style="width: 170px"></div>
            <div class="ptext"><p>Real del Monte No. 108-3, Villas del Parque</p></div>
            <div class="ptext1"><p>caporceqro@gmail.com</p></div>
            <div class="ptext2"><p>Tel. 243 23 38</p></div>

        <?php
        include '../libs/conexion.php';



        $idCliente = $_GET['idCliente'];
        $idVenta = $_GET['idVenta'];



        $tablaDeMysql = "ventas"; //Define el nombre de la tabla donde estan los datos
        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND id_ventas LIKE '".$idVenta."'";
        $resultado = $mysqli->query($consulta);

// $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


while ($row1=mysqli_fetch_row($resultado))
{

        //Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT * FROM clientes WHERE activo LIKE 1 AND id_clientes LIKE '".$idCliente."'";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {


            $nombre = $row[1];

            $direccion = $row[2];
            $telefono = $row[3];





        ?>
        <table style="width: 5%" class="table-position">
            <thead>
             <tr>

                <th class="nota">NOTA DE VENTA</th>

            </tr>
            </thead>
            <tbody>

                <tr>

                    <td class="rojo"><?php echo $row1[2]; ?></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        <table style="width: 5%" class="table-position1">
            <thead>
            <tr>

                <th class="nota" style="font-size: 10px">EXPEDIDA EN QUERETARO, QRO.</th>

            </tr>
            </thead>
            <tbody>

            <tr>

                <td><?php echo $row1[6]; ?></td>

            </tr>
<?php } ?>
            </tbody>
        </table>
        <br>

        <?php



        $tablaDeMysql = "ventas"; //Define el nombre de la tabla donde estan los datos


        //Checamos si se lleno el campo de usuario en el formulario


        $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE activo LIKE 1 AND id_clientes LIKE '".$idCliente."' AND id_ventas = '".$idVenta."' ";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


        while ($row=mysqli_fetch_row($resultado))
        {


            $idVentas = $row[0];

            $chofer = $row[3];

            $total = $row[4];



        }


        ?>

        <div class="div_border">
            <div><p>&nbsp;Nombre: <?php echo $nombre; ?></p></div>
            <div><p>&nbsp;Direccion: <?php echo $direccion; ?></p></div>
            <div><p>&nbsp;Tel: <?php echo $telefono; ?></p></div>
            <div class="div_chofer"><p>Chofer: <?php echo $chofer; ?></p></div>
            <br>

        </div>
        <br>
        <div>
        <table>
            <thead>
            <tr>

                <th class="ancho_cant">CANT</th>
                <th class="ancho_desc">DESCRIPCION</th>
                <th class="ancho_kilos">KILOS</th>
                <th class="ancho_punit">P.UNIT</th>
                <th class="ancho_impor">IMPORTE</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $contador1 = 0;
            $contador2 = 12;


                $tablaDeMysql = "producto_venta"; //Define el nombre de la tabla donde estan los datos


                $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE  id_ventas = '".$idVenta."' ";
                $resultado = $mysqli->query($consulta);


            while($contador1 < $contador2){
                while ($row=mysqli_fetch_row($resultado))
                {


            ?>

            <tr>

                <td> <?php echo $row[3]; ?></td>
                <td> <?php echo $row[4]; ?></td>
                <td> <?php echo $row[5]; ?></td>
                <td> <?php echo $row[6]; ?></td>
                <td> <?php echo $row[7]; ?></td>


            </tr>
            <?php
                    $contador1 ++;
                }

                if($contador1 < $contador2){

                    ?>
                    <tr>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>

                    <?php
                    $contador1++;
                }
            }
            ?>
            </tbody>
        </table>
            </div>
        <div style="border: 1px; border-bottom-left-radius: 10px 10px; border-bottom-right-radius: 10px 10px;">
            <p style="vertical-align: text-top;">Cantidad con Letra</p>
            <br>
        </div>
        <table class="table-position2">
            <tr><th style="width: 90px; height: 40px; text-align: center">TOTAL ($)</th>
                <td style="width: 90px; text-align: center"><?php echo $total; ?></td></tr>

        </table>
        <div class="ptext_clau">
            <p style="font-size: 8px;">Debo(emos) y Pagará(mos) incondicionalmente a la orden de Mario Eduardo Campo Gonzalez, la cantidad de $&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   importe de la mercancias
             recibidas a mi (nuestra) entera satisfacción. Si este pagaré no es liquidado a su vencimiento el &nbsp;&nbsp;&nbsp;&nbsp;     de&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        del&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      causará intereses moratorios a razón de&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     % mensual.</p>
        </div>
        <div class="ptext_acepto">
            <p style="font-size: 12px;">Acepto:</p>
        </div>

    </page>

<?php
$content = ob_get_clean();

require_once('../libs/html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A5','fr','UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->includeJS('print(TRUE)');
$pdf->output('nota.pdf');

?>