<?php
$nro_unk = $_SESSION['nro_doc_acc'];
$mensaje = "";
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
ON R.cod_persona = P.cod_persona
WHERE R.estado = 1 AND R.usu_crea = '$nro_unk';";
$resultado = $conectar->Seleccionar($consulta);
if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    while($fila=$resultado->fetch_array()){
        $mensaje.='<option value="'.$fila[0].'">'.$fila[1]." - ".$fila[3]." - ".$fila[4].'</option>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>