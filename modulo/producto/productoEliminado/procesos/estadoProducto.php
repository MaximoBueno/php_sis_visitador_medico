<?php
$datoR = NULL;
$datoI = NULL;
$mensaje = "";
if(isset($_POST['valor']) && isset($_POST['ind'])){
    $datoR = $_POST['valor'];
    $datoI = $_POST['ind'];
    
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "UPDATE producto SET estado=$datoI WHERE cod_producto = $datoR;";
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