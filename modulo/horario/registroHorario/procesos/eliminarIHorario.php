<?php
$datoR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datoR = $_POST['valor'];

    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "DELETE FROM horario WHERE cod_horario = $datoR;";
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