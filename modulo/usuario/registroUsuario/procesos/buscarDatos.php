<?php
$mensaje = "";
if(isset($_POST['valor'])){
    
    require('./../../../conexion/funciones.php');
    
    $codigo = $_POST['valor'];

    $conectar = new Funciones();

    $consulta = "SELECT cod_persona, CONCAT(ap_paterno, ' ', ap_materno) AS 'AC', nombres, cod_tp_persona, nro_documento 
    FROM persona WHERE cod_persona = ".$codigo." LIMIT 1;";

    $resultado = $conectar->Seleccionar($consulta);

    if(mysqli_num_rows($resultado)>0){

        $fila = $resultado->fetch_array();
        $mensaje =  $fila[0]."|".$fila[1]."|".$fila[2]."|".$fila[3]."|".$fila[4];
    }
    
    $resultado->free();
}
echo $mensaje;
?>