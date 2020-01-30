<?php
$mensaje = "";
$filtro = "00-00-0000";
$nro_unk = "";
$agregado = "";

if(isset($_POST['valor'])){
    $filtro = $_POST['valor'];
    require('./../../../conexion/funciones.php');
    session_start();
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "AND H.fecha = '$filtro'";
}else{
    require('./../../conexion/funciones.php');
    $nro_unk = $_SESSION['nro_doc_acc'];
    $agregado = "AND H.fecha = '$filtro'";
}

include("tools.php");
$tool = new tools();

//MIS VECTORES (BLOQUES)
$lunes = [];
$marte = [];
$mierc = [];
$jueve = [];
$virne = [];

$lunesA = [];
$marteA = [];
$miercA = [];
$jueveA = [];
$virneA = [];

//OBTENEMOS TODOS LOS DATOS Y LO ALMACENAMOS EN UNA MATRIZ
$conectar = new Funciones();
//$consulta = "SELECT * FROM horario ORDER BY dia ASC;";
$consulta = "SELECT H.fecha, H.dia, 
H.hora, D.distrito,
CS.centro_salud,
CONCAT(P.ap_paterno, ' ', P.ap_materno, ', ', P.nombres) AS 'Nombres', 
R.direccion,
PO.producto
FROM horario AS H
JOIN distrito AS D 
ON H.cod_distrito = D.cod_distrito
JOIN rutas AS R
ON H.cod_ruta = R.cod_ruta
JOIN centro_salud AS CS
ON R.cod_c_salud = CS.cod_c_salud
JOIN persona AS P
ON R.cod_persona = P.cod_persona
JOIN producto AS PO
ON H.cod_producto = PO.cod_producto
WHERE H.estado = 1 AND H.usu_crea = '$nro_unk' ".$agregado." 
ORDER BY H.dia ASC;";

$resultado = $conectar->Seleccionar($consulta);

if($resultado != false){
    if(mysqli_num_rows($resultado)>0){
        while($fila=$resultado->fetch_array()){
            if($fila[2] == 1){
                if ($fila[1] == 1){
                    array_push($lunes, $fila);
                }else if($fila[1] == 2){
                    array_push($marte, $fila);
                }else if($fila[1] == 3){
                    array_push($mierc, $fila);
                }else if($fila[1] == 4){
                    array_push($jueve, $fila);
                }else if($fila[1] == 5){
                    array_push($virne, $fila);
                }
            }else{
                if ($fila[2] == 1){
                    array_push($lunesA, $fila);
                }else if($fila[1] == 2){
                    array_push($marteA, $fila);
                }else if($fila[1] == 3){
                    array_push($miercA, $fila);
                }else if($fila[1] == 4){
                    array_push($jueveA, $fila);
                }else if($fila[1] == 5){
                    array_push($virneA, $fila);
                }
            }
        }
    }
}
//$resultado->close(); //SE DEBERIA CERRAR LA CONEXION y de hecho si se cierra la conexion en la clase conexion xD

$my_cont = 0;
for($i = 0; $i < 6 - 1; $i++){
    if($i == 0){
        $mensaje.="<tr><td colspan=7 class='text-center text-white bg-dark'><b>A. M.</b></td></tr>";
    }

    $mensaje.="<tr>
        <td class='text-center'>".($i + 1)."</td>
        <td style='width:50px;display:none;' class='text-center'></td>
        <td>".$tool->siExiste($lunes, $i)."</td>
        <td>".$tool->siExiste($marte, $i)."</td>
        <td>".$tool->siExiste($mierc, $i)."</td>
        <td>".$tool->siExiste($jueve, $i)."</td>
        <td>".$tool->siExiste($virne, $i)."</td>
    </tr>";

    if($i == 4){
        $mensaje.="<tr><td colspan=7 class='text-center text-white bg-dark'><b>P. M.</b></td></tr>";
    }
    $my_cont += 1;
}
for($i = 0; $i < 8 - 1; $i++){
    $mensaje.="<tr>
        <td class='text-center'>".($my_cont + 1)."</td>
        <td style='width:50px;display:none;' class='text-center'></td>
        <td>".$tool->siExiste($lunesA, $i)."</td>
        <td>".$tool->siExiste($marteA, $i)."</td>
        <td>".$tool->siExiste($miercA, $i)."</td>
        <td>".$tool->siExiste($jueveA, $i)."</td>
        <td>".$tool->siExiste($virneA, $i)."</td>
    </tr>";
    $my_cont+=1;
}
echo $mensaje;
?>