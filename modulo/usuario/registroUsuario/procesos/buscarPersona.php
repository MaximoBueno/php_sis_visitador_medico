<?php
$nro_documento = "";
$consulta = "";
$mensaje = "";
$agregado = "";
if(isset($_POST['valor'])){
    $nro_documento = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    $agregado = "WHERE CONCAT(ap_paterno, ' ', ap_materno) LIKE CONCAT('%','$nro_documento','%') AND estado = 1";
}else{
    //require('./../../conexion/funciones.php');
    $agregado = "WHERE estado = 1";
}

$conectar = new Funciones();

$consulta = "SELECT cod_persona, 
CONCAT(ap_paterno, ' ', ap_materno) AS 'NC', 
nombres
FROM persona ".$agregado." ORDER BY cod_persona ASC LIMIT 10;";

$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $is_id = "";
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        
        if($cont == 1){$is_id = "id='setbuscarNow'";}else{$is_id="";}
        
        $mensaje.='<tr class="text-center" style="cursor:pointer;" ondblclick="seleccionarPersonal(this);" '.$is_id.'>
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-left">'.$fila[1].', '.$fila[2].'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>

