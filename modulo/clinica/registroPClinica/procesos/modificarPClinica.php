<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();
    $consulta = "UPDATE clinicaproducto SET fecha_horario='$datosR[0]', cod_producto=$datosR[1], cod_c_salud=$datosR[2] WHERE cod_clinica_producto=$datosR[3];";
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