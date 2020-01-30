<?php
$mensaje = "";
//CONCAT(H.hecho, '-', H.cod_horario) 
if(isset($_POST['v1']) && isset($_POST['v2'])){
    $codigo = $_POST['v1'];
    $valor = $_POST['v2'];
    
    require('./../../../conexion/funciones.php');

    $conectar = new Funciones();

    $consulta = "UPDATE horario SET hecho=$valor WHERE cod_horario=$codigo;";
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