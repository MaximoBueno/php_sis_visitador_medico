<?php
$cod_linea_producto = $_POST["valor"];
$agregado = "";
$mensaje = "";
$nro_unk = "";

session_start();
$nro_unk = $_SESSION['nro_doc_acc'];

//echo $cod_linea_producto;
$agregado = " WHERE PL.usu_crea = '$nro_unk' AND PL.cod_linea_producto = ".$cod_linea_producto;



require('./../../../conexion/funciones.php');
$conectar = new Funciones();
/*
SELECT PL.cod_producto_lineado, LP.descripcion, P.descripcion FROM producto_lineado AS  PL 
JOIN linea_producto AS LP
ON PL.cod_linea_producto = LP.cod_linea_producto 
JOIN producto AS P
ON PL.cod_producto = P.cod_producto
*/
$consulta = "SELECT PL.cod_producto_lineado, LP.descripcion, P.producto FROM producto_lineado AS  PL 
JOIN linea_producto AS LP
ON PL.cod_linea_producto = LP.cod_linea_producto 
JOIN producto AS P
ON PL.cod_producto = P.cod_producto ".$agregado." ORDER BY PL.cod_producto_lineado ASC";

$resultado = $conectar->Seleccionar($consulta);

//$mensaje = $consulta;
//'modalMul(7, ".$valor.")'
//AFTER => onclick="eliminar(this);"

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<tr class="text-center">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">
                         <button type="button" id="btn-eliminar" class="btn btn-danger btn-sm" onclick="modalMul(7,'.$fila[0].');">
                            <i class="fa fa-window-close-o tam-icon"></i></button>
                         </th>
                     </tr>';
        $cont += 1;
    }
}

$resultado->free();

echo $mensaje;
?>