<?php
$producto= "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";
if(isset($_POST['valor'])){
    $producto = $_POST['valor'];

    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    require('./../../../conexion/funciones.php');
    $agregado = "WHERE usu_crea = '$nro_unk' AND producto LIKE CONCAT('%','$producto','%') AND estado = 1";
}else{
    require('./../../conexion/funciones.php'); //->porque ya existe la clase conexion instanciada
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE usu_crea = '$nro_unk' AND estado = 1";
}

$conectar = new Funciones();
$consulta = "SELECT cod_producto, producto, descripcion FROM producto ".$agregado." ORDER BY cod_producto ASC LIMIT 10;";
$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<tr class="text-center" style="cursor:pointer;" ondblclick="obtenerRegistro(this);">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>