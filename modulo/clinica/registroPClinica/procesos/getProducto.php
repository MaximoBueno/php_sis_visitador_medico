<?php
require('./../../conexion/funciones.php'); //Doble include conexion por eso se comenta

$nro_unk = $_SESSION['nro_doc_acc'];

$mensaje = "";
$conectar = new Funciones();
$consulta = "SELECT cod_producto, producto, estado FROM producto WHERE estado = 1 AND usu_crea = '$nro_unk';";
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