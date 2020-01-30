<?php
$filtro = "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";

if(isset($_POST['valor'])){
    $filtro = $_POST['valor'];

    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];

    require('./../../../conexion/funciones.php');
    $agregado = "WHERE CP.usu_crea = '$nro_unk' AND CP.fecha_horario = '$filtro' AND CP.estado = 1";
    if($filtro == "-"){
        $agregado = "WHERE CP.usu_crea = '$nro_unk' AND CP.estado = 1";
    }else{
        $agregado = "WHERE CP.usu_crea = '$nro_unk' AND CP.fecha_horario = '$filtro' AND CP.estado = 1";
    }
}else{
    //require('./../../conexion/funciones.php'); //->porque ya existe la clase conexion instanciada
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE CP.usu_crea = '$nro_unk' AND CP.estado = 1";
}

$conectar = new Funciones();

$consulta = "SELECT CP.cod_clinica_producto, CP.fecha_horario, 
P.producto, CS.centro_salud,
CS.direccion
FROM clinicaproducto AS CP
JOIN producto AS P
ON CP.cod_producto = P.cod_producto
JOIN centro_salud AS CS
ON CP.cod_c_salud = CS.cod_c_salud ".$agregado." ORDER BY CP.cod_clinica_producto ASC LIMIT 10;";

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
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>