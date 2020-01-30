<?php
$linea_producto= "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";
if(isset($_POST['valor'])){
    $linea_producto = $_POST['valor'];

    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    require('./../../../conexion/funciones.php');
    $agregado = "WHERE usu_crea = '$nro_unk' AND linea_producto LIKE CONCAT('%','$linea_producto','%') AND estado = 1";
}else{
    if(isset($_POST['load'])){
        require('./../../../conexion/funciones.php'); //->para hacer en el load
        
        session_start();
        $nro_unk = $_SESSION['nro_doc_acc'];
        
        $agregado = "WHERE usu_crea = '$nro_unk' AND estado = 1";
    }else{
        require('./../../conexion/funciones.php'); //->porque ya existe la clase conexion instanciada
        $nro_unk = $_SESSION['nro_doc_acc'];
        $agregado = "WHERE usu_crea = '$nro_unk' AND estado = 1";
    }
}



$conectar = new Funciones();
$consulta = "SELECT cod_linea_producto, linea_producto, descripcion FROM linea_producto ".$agregado." ORDER BY cod_linea_producto ASC LIMIT 10;";
$resultado = $conectar->Seleccionar($consulta);
if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<tr class="text-center" style="cursor:pointer;" ondblclick="cargarProducto(this, 1);">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">
                         <button type="button" id="btn-modificar" class="btn btn-success btn-sm" onclick="modificar(this);">
                            <i class="fa fa-pencil-square-o tam-icon"></i></button>
                         </th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>