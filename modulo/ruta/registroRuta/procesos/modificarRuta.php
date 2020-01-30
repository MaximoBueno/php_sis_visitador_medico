<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();
    $consulta = "UPDATE rutas SET cod_c_salud=$datosR[0], cod_distrito=$datosR[1], cod_persona=$datosR[2], direccion='$datosR[3]' WHERE cod_ruta=$datosR[4];";
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