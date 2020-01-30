<?php
/** Incluir la libreria PHPExcel */
error_reporting(0);

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
    ->setCellValue('B1', 'Apellido Paterno')
    ->setCellValue('C1', 'Apellido Materno')
    ->setCellValue('D1', 'Nombres')
    ->setCellValue('E1', 'Tipo Documento')
    ->setCellValue('F1', 'Nro. Documento')
    ->setCellValue('G1', 'Género')
    ->setCellValue('H1', 'Fecha Nacimiento')
    ->setCellValue('I1', 'Dirección');


session_start();
$nro_unk = $_SESSION['nro_doc_acc'];

require_once('../../../conexion/funciones.php');
$conectar = new Funciones();
$consulta = "SELECT P.cod_persona, 
P.ap_paterno, 
P.ap_materno, 
P.nombres, 
TD.acronimo, 
P.nro_documento, 
G.genero, 
P.fecha_nacimiento, 
P.direccion 
FROM persona AS P
JOIN tipo_documento AS TD
ON P.cod_tp_documento = TD.cod_tp_documento
JOIN genero AS G
ON P.cod_genero = G.cod_genero 
WHERE P.cod_tp_persona = 2 AND  usuario_crea = '$nro_unk' AND P.estado = 1;";
$resultado = $conectar->Seleccionar($consulta);
$myFilas = 1;
if(mysqli_num_rows($resultado)>0){
    $cont = 1;
    $i = 2;
    while($fila=$resultado->fetch_array()){
        $objPHPExcel->getActiveSheet()
            ->SetCellValue('A'.$i, $cont)
            ->SetCellValue('B'.$i, $fila[1])
            ->SetCellValue('C'.$i, $fila[2])
            ->SetCellValue('D'.$i, $fila[3])
            ->SetCellValue('E'.$i, $fila[4])
            ->SetCellValue('F'.$i, $fila[5])
            ->SetCellValue('G'.$i, $fila[6])
            ->SetCellValue('H'.$i, $fila[7])
            ->SetCellValue('I'.$i, $fila[8])
        $i += 1;
        $cont += 1;
        $myFilas += 1;
    }
}

$resultado->free();

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
$objPHPExcel->getActiveSheet()->getStyle('A1:A'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('E1:E'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('F1:F'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('G1:G'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('H1:H'.$myFilas)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('I1:I'.$myFilas)->applyFromArray($styleArrayBorder);

//Set Color de fondo
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->applyFromArray($styleArrayBgm);

//Eliminando Variables
unset($styleArrayBorder);
unset($styleArrayBgm);

//Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Personal');

//Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteMedico.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

ob_end_clean();
$objWriter->save('php://output');
exit;
?>