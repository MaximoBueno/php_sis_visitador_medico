<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "UPDATE persona SET ap_paterno='$datosR[0]', ap_materno='$datosR[1]', nombres='$datosR[2]', cod_tp_documento=$datosR[3], nro_documento=$datosR[4], cod_genero=$datosR[5], cod_tp_persona=$datosR[6], fecha_nacimiento='$datosR[7]', direccion='$datosR[8]' WHERE cod_persona=$datosR[9];";
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