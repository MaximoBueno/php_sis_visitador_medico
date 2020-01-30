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
    $agregado = "WHERE R.usu_crea = '$nro_unk' AND R.direccion LIKE CONCAT('%','$filtro','%')";
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE R.usu_crea = '$nro_unk'";
}

$conectar = new Funciones();
$consulta = "SELECT R.cod_ruta, CS.centro_salud, D.distrito, 
CONCAT(P.ap_paterno, ' ', P.ap_materno, ', ', P.nombres) AS 'Nombres', 
R.direccion, R.estado
FROM rutas AS R
JOIN centro_salud AS CS
ON R.cod_c_salud = CS.cod_c_salud
JOIN distrito AS D
ON R.cod_distrito = D.cod_distrito
JOIN persona AS P
ON R.cod_persona = P.cod_persona ".$agregado." ORDER BY R.cod_ruta ASC LIMIT 10;";

$resultado = $conectar->Seleccionar($consulta);

if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){

        if($fila[5] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarRuta('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarRuta('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
        }

        $mensaje.='<tr class="text-center">
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