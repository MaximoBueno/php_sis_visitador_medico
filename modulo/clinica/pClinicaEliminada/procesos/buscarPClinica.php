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
    if($filtro == "-"){
        $agregado = "WHERE CP.usu_crea = '$nro_unk'";
    }else{
        $agregado = "WHERE CP.usu_crea = '$nro_unk' AND CP.fecha_horario = '$filtro'";
    }
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE CP.usu_crea = '$nro_unk'";
}

$conectar = new Funciones();

$consulta = "SELECT CP.cod_clinica_producto, 
CP.fecha_horario, 
P.producto, 
CS.centro_salud,
CS.direccion,
CP.estado
FROM clinicaproducto AS CP
JOIN producto AS P
ON CP.cod_producto = P.cod_producto
JOIN centro_salud AS CS
ON CP.cod_c_salud = CS.cod_c_salud ".$agregado." ORDER BY CP.cod_clinica_producto ASC LIMIT 10;";

$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    $icono = "";
    while($fila=$resultado->fetch_array()){
        if($fila[5] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarPClinica('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarPClinica('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
        }
        
        $mensaje.='<tr class="text-center" style="cursor:pointer;" ondblclick="obtenerRegistro(this);">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">'.$fila[3].'</th>
                         <td class="text-center">'.$fila[4].'</th>
                         <td class="text-center">'.$icono.'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>