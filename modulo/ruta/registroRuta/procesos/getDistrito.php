<?php
//require('./../../conexion/funciones.php');
$mensaje = "";
$conectar = new Funciones();
$consulta = "SELECT cod_distrito, distrito, estado FROM distrito WHERE estado = 1";
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