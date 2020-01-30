<?php
require('./../../conexion/funciones.php');
$nro_unk = $_SESSION['nro_doc_acc'];
$mensaje = "";
$conectar = new Funciones();
$consulta = "SELECT cod_persona, CONCAT(ap_paterno, ' ' , ap_materno, ', ', nombres) FROM persona WHERE cod_tp_persona = 2 AND estado = 1 AND usuario_crea = '$nro_unk';";
$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<option value="'.$fila[0].'">'.$fila[1].'</option>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>