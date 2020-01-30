<?php
$nro_documento = "";
$consulta = "";
$mensaje = "";
$agregado = "";
if(isset($_POST['valor'])){
    $nro_documento = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    $agregado = "WHERE CONCAT(P.ap_paterno, ' ', P.ap_materno) LIKE CONCAT('%','$nro_documento','%') AND P.estado = 1";
}else{
    //require('./../../conexion/funciones.php');
    $agregado = "WHERE P.estado = 1";
}

$conectar = new Funciones();

$consulta = "SELECT P.cod_persona, P.ap_paterno, P.ap_materno, 
P.nombres, TD.acronimo, P.nro_documento, 
G.genero, TP.tipo_persona, P.fecha_nacimiento, 
P.direccion 
FROM persona AS P
JOIN tipo_documento AS TD
ON P.cod_tp_documento = TD.cod_tp_documento
JOIN tipo_persona AS TP
ON P.cod_tp_persona = TP.cod_tp_persona
JOIN genero AS G
ON P.cod_genero = G.cod_genero ".$agregado." ORDER BY P.cod_persona ASC LIMIT 10;";

$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<tr class="text-center" style="cursor:pointer;" ondblclick="obtenerRegistro(this);">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">'.$fila[3].'</th>
                         <td class="text-center">'.$fila[4].'</th>
                         <td class="text-center">'.$fila[5].'</th>
                         <td class="text-center">'.$fila[6].'</th>
                         <td class="text-center">'.$fila[7].'</th>
                         <td class="text-center">'.$fila[8].'</th>
                         <td class="text-center">'.$fila[9].'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>