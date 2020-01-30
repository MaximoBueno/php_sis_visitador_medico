<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    
    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    $conectar = new Funciones();

    $consulta = "INSERT INTO rutas(cod_c_salud, cod_distrito, cod_persona,direccion, usu_crea) VALUES ($datosR[0], $datosR[1], $datosR[2],'$datosR[3]', '$nro_unk');";

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