<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    $conectar = new Funciones();
    $consulta = "SELECT cod_horario, fecha, dia, hora, cod_distrito, cod_ruta, cod_producto FROM horario WHERE cod_horario = $datosR LIMIT 1;";
    $resultado = $conectar->Seleccionar($consulta);
    $fila=$resultado->fetch_array();
    $mensaje = $fila[0]."|".$fila[1]."|".$fila[2]."|".$fila[3]."|".$fila[4]."|".$fila[5]."|".$fila[6];
    echo $mensaje;
}else{
    $mensaje = "0|0|0|0|0|0";
    echo $mensaje;
}
?>