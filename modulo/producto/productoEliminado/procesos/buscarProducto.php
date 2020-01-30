<?php
$producto = "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";
if(isset($_POST['valor'])){
    $producto = $_POST['valor'];
    
    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];
    
    require('./../../../conexion/funciones.php');
    $agregado = "WHERE usu_crea = '$nro_unk' AND producto LIKE CONCAT('%','$producto','%')";
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE usu_crea = '$nro_unk'";
}

$conectar = new Funciones();
$consulta = "SELECT cod_producto, producto, descripcion, estado FROM producto ".$agregado." ORDER BY cod_producto ASC LIMIT 10;";
$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){

        if($fila[3] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarProducto('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarProducto('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
        }

        $mensaje.='<tr class="text-center">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">'.$icono.'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>