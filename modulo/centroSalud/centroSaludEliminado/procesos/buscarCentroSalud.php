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
    $agregado = "WHERE C.usu_crea = '$nro_unk' AND C.centro_salud LIKE CONCAT('%','$centro_salud','%')";
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "WHERE C.usu_crea = '$nro_unk'";
}

$conectar = new Funciones();

$consulta = "SELECT C.cod_c_salud,
C.centro_salud,
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
        if($fila[4] == 1){
            $icono = '<button type="button" id="btn-deshabilitar" class="btn btn-success btn-sm" onclick="deshabilitarCentroSalud('.$fila[0].');"><i class="fa fa-check-circle-o tam-icon"></i></button>';
        }else{
            $icono = '<button type="button" id="btn-habilitar" class="btn btn-danger btn-sm" onclick="habilitarCentroSalud('.$fila[0].');"><i class="fa fa-window-close-o tam-icon"></i></button>';
        }

        $mensaje.='<tr class="text-center">
                         <th class="text-center">'.$cont.'</th>
                         <th class="text-center" style="display: none;" >'.$fila[0].'</th>
                         <td class="text-center">'.$fila[1].'</th>
                         <td class="text-center">'.$fila[2].'</th>
                         <td class="text-center">'.$fila[3].'</th>
                         <td class="text-center">'.$icono.'</th>
                     </tr>';
        $cont += 1;
    }
}
$resultado->free();
echo $mensaje;
?>