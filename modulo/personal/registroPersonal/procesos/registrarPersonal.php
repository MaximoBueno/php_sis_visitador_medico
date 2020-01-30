<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    
    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    $conectar = new Funciones();

    $consulta = "INSERT INTO persona(ap_paterno, ap_materno, nombres, cod_tp_documento, nro_documento, cod_genero, cod_tp_persona, fecha_nacimiento, direccion, usu_crea) VALUES('$datosR[0]','$datosR[1]','$datosR[2]',$datosR[3],'$datosR[4]',$datosR[5], $datosR[6],'$datosR[7]','$datosR[8]','$nro_unk');";

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