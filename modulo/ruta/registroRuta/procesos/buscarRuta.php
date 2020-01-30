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
    $agregado = "WHERE R.usu_crea = '$nro_unk' AND R.direccion LIKE CONCAT('%','$filtro','%') AND R.estado = 1";
}else{
    //require('./../../conexion/funciones.php'); //->porque ya existe la clase conexion instanciada
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE R.usu_crea = '$nro_unk' AND R.estado = 1";
}

$conectar = new Funciones();

$consulta = "SELECT R.cod_ruta, CS.centro_salud, D.distrito, 
CONCAT(P.ap_paterno, ' ', P.ap_materno, ', ', P.nombres) AS 'Nombres', 
R.direccion
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