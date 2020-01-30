<?php
$datoR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datoR = $_POST['valor'];

    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "DELETE FROM producto_lineado WHERE cod_producto_lineado = $datoR;";
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