<?php
$centro_salud = "";
$consulta = "";
$mensaje = "";
$agregado = "";
$nro_unk = "";
if(isset($_POST['valor'])){
    $centro_salud = $_POST['valor'];
    
    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];
    
    require('./../../../conexion/funciones.php');
    $agregado = "WHERE C.usu_crea = '$nro_unk' AND C.centro_salud LIKE CONCAT('%','$centro_salud','%') AND C.estado = 1";
}else{
    //require('./../../conexion/funciones.php'); ->porque ya existe la clase conexion instanciada
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE C.usu_crea = '$nro_unk' AND C.estado = 1";
}

$conectar = new Funciones();
$consulta = "SELECT C.cod_c_salud,
C.centro_salud,
CASE C.tipo
WHEN 'HOSP' THEN 'Hospital'
WHEN 'FARM' THEN 'Farmacia'
WHEN 'CICL' THEN 'Clinica'
ELSE 'Ninguno' END 'tipo',
D.distrito,
C.direccion,
C.estado
FROM centro_salud AS C
JOIN distrito AS D
ON C.cod_distrito = D.cod_distrito ".$agregado." ORDER BY C.cod_c_salud ASC LIMIT 10;";

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