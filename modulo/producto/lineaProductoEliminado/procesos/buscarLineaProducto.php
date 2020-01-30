<?php
$linea_producto = "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";

if(isset($_POST['valor'])){
    $linea_producto = $_POST['valor'];

    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    require('./../../../conexion/funciones.php');
    $agregado = "WHERE usu_crea = '$nro_unk' AND linea_producto LIKE CONCAT('%','$linea_producto','%')";
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE usu_crea = '$nro_unk'";
}

$conectar = new Funciones();
$consulta = "SELECT cod_linea_producto, linea_producto, descripcion, estado FROM linea_producto ".$agregado." ORDER BY cod_linea_producto ASC LIMIT 10;";
$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){

        if($fila[3] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarLineaProducto('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarLineaProducto('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
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