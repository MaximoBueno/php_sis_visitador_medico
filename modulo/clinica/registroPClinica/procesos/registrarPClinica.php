<?php
$datosR = NULL;
$mensaje = "";
if(isset($_POST['valor'])){
    $datosR = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    
    session_start();
   


    $conectar = new Funciones();

    $consulta = "INSERT INTO clinicaproducto(fecha_horario, cod_producto, cod_c_salud, usu_crea) VALUES ('$datosR[0]', $datosR[1], $datosR[2],'$nro_unk');";

    $resultado = $conectar->Seleccionar($consulta);
    
    if($resultado == true){
        $mensaje = "OK";
    }else{
        $mensaje = "NO";
    }
    echo $mensaje;
}else{
    echo "NE";
}
?>