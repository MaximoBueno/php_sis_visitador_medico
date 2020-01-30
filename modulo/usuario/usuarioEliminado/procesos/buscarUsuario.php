<?php
$nro_documento = "";
$consulta = "";
$mensaje = "";
$agregado = "";
if(isset($_POST['valor'])){
    $nro_documento = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    $agregado = "WHERE CONCAT(P.ap_paterno, ' ', P.ap_materno) LIKE CONCAT('%','$nro_documento','%')";
}else{
    require('./../../conexion/funciones.php');
    $agregado = "";
}

$conectar = new Funciones();

$consulta = "SELECT U.cod_usuario, 
CONCAT(P.ap_paterno, ' ', P.ap_materno) AS 'NC' , 
P.nombres, 
TP.tipo_persona, 
U.usuario, 
U.contrasenia, 
U.estado
FROM usuarios AS U JOIN persona AS P
ON U.cod_persona = P.cod_persona
JOIN tipo_persona AS TP
ON U.cod_tp_persona = TP.cod_tp_persona ".$agregado." ORDER BY U.cod_usuario ASC LIMIT 10;";

$resultado = $conectar->Seleccionar($consulta);
$icono = "";
if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        
        if($fila[6] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarPersonal('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarPersonal('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
        }

        $mensaje.='<tr class="text-center">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">'.$fila[3].'</th>
                         <td class="text-center">'.$fila[4].'</th>
                         <td class="text-center">'.$fila[5].'</th>
                         <td class="text-center">'.$icono.'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>