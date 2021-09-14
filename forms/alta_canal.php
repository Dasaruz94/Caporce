<?php
include('librerias.php');
?>

<form class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="">Numero de Canales</label>
        <input type="number" class="form-control" id="numero_canales" placeholder="Introduce el numero de canales">
    </div>
    <div class="form-group">
        <label class="sr-only" for="">Fecha</label>
        <input type="date" class="form-control" id="fecha_ingreso">
    </div>

    <button type="submit" class="btn btn-default">Entrar</button>
</form>