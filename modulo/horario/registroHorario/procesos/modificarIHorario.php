<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "UPDATE horario SET fecha='$datosR[0]', dia=$datosR[1], hora=$datosR[2], cod_distrito=$datosR[3], cod_ruta=$datosR[4], cod_producto=$datosR[5] WHERE cod_horario=$datosR[6];";
    $resultado = $conectar->Seleccionar($consulta);
    
    if($resultado == true){
        $mensaje = "OK";
    }else{
        $mensaje = "NUL";
    }
    echo $mensaje;
}else{
    echo $mensaje;
}
?>