<?php
/** Incluir la libreria PHPExcel */
//error_reporting(0);

require_once('../../../PHPExcel/Classes/PHPExcel.php');

//Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//Establecer propiedades
$objPHPExcel->getProperties()
    ->setCreator("BUMH")
    ->setLastModifiedBy("BUMH")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel de Reporte")
    ->setDescription("Reporte desde PHP.")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Reportes de Excel");

//Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'N°')
    ->setCellValue('B1', 'LUNES')
    ->setCellValue('C1', 'MARTES')
    ->setCellValue('D1', 'MIERCOLES')
    ->setCellValue('E1', 'JUEVES')
    ->setCellValue('F1', 'VIERNES');

$filtro = $_POST['my_fecha'];
session_start();
$nro_unk = $_SESSION['nro_doc_acc'];
$agregado = "AND H.fecha = '$filtro'";

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

require_once('../../../conexion/funciones.php');

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

//$resultado->free();

$my_cont = 0;
$fill_my = 0;

for($i = 0; $i < 6 - 1; $i++){
    if($i == 0){
        //$mensaje.="<tr><td colspan=7 class='text-center text-white bg-dark'><b>A. M.</b></td></tr>";
    }
    
    $fill_my = ($i + 2);

    $objPHPExcel->getActiveSheet()
    ->SetCellValue('A'.$fill_my, ($i + 1))
    ->SetCellValue('B'.$fill_my, $tool->siExisteE($lunes, $i))
    ->SetCellValue('C'.$fill_my, $tool->siExisteE($marte, $i))
    ->SetCellValue('D'.$fill_my, $tool->siExisteE($mierc, $i))
    ->SetCellValue('E'.$fill_my, $tool->siExisteE($jueve, $i))
    ->SetCellValue('F'.$fill_my, $tool->siExisteE($virne, $i));

    if($i == 4){
        //$mensaje.="<tr><td colspan=7 class='text-center text-white bg-dark'><b>P. M.</b></td></tr>";
    }
    $my_cont += 1;
}
$fill_my = 0;
for($i = 0; $i < 8 - 1; $i++){
    $fill_my = ($my_cont + 1);
     $objPHPExcel->getActiveSheet()
    ->SetCellValue('A'.$fill_my, ($my_cont + 1))
    ->SetCellValue('B'.$fill_my, $tool->siExisteE($lunesA, $i))
    ->SetCellValue('C'.$fill_my, $tool->siExisteE($marteA, $i))
    ->SetCellValue('D'.$fill_my, $tool->siExisteE($miercA, $i))
    ->SetCellValue('E'.$fill_my, $tool->siExisteE($jueveA, $i))
    ->SetCellValue('F'.$fill_my, $tool->siExisteE($virneA, $i));
    
    $my_cont+=1;
}


//Estilo pre definido
$styleArrayBorder = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$styleArrayBgm = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'F28A8C'
    ));

//Set Bordes
$objPHPExcel->getActiveSheet()->getStyle('A1:A'.$my_cont)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$my_cont)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$my_cont)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$my_cont)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('E1:E'.$my_cont)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('F1:F'.$my_cont)->applyFromArray($styleArrayBorder);


$objPHPExcel->getActiveSheet()->getStyle('A1:A'.$my_cont)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$my_cont)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$my_cont)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$my_cont)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('E1:E'.$my_cont)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('F1:F'.$my_cont)->getAlignment()->setWrapText(true);


//Set Color de fondo
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFill()->applyFromArray($styleArrayBgm);


/*foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) { 
    $rd->setRowHeight(-1); 
}*/


/*
for($col = 'A'; $col !== 'G'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
*/ 
/* //COMBINAR CELDAS
$objPHPExcel->getActiveSheet()->mergeCells('A'.$my_cont.':F'.$my_cont);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$my_cont, "FUSION XD");*/

foreach(range('A','F') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

//Eliminando Variables
unset($styleArrayBorder);
unset($styleArrayBgm);

//Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Asistencia');

//Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteAsistencia.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

ob_end_clean();
$objWriter->save('php://output');
exit;
?>