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
    ->setCellValue('B1', 'Apellidos')
    ->setCellValue('C1', 'Nombres')
    ->setCellValue('D1', 'Tipo Persona')
    ->setCellValue('E1', 'Usuario')
    ->setCellValue('F1', 'Contraseña');

require_once('../../../conexion/funciones.php');
$conectar = new Funciones();
$consulta = "SELECT U.cod_usuario, CONCAT(P.ap_paterno, ' ', P.ap_materno) AS 'NC' , P.nombres, TP.tipo_persona, U.usuario, U.contrasenia
FROM usuarios AS U JOIN persona AS P
ON U.cod_persona = P.cod_persona
JOIN tipo_persona AS TP
ON U.cod_tp_persona = TP.cod_tp_persona WHERE U.estado = 1 ORDER BY U.cod_usuario;";

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
            ->SetCellValue('F'.$i, $fila[5]);
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

//Set Color de fondo
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFill()->applyFromArray($styleArrayBgm);

//Eliminando Variables
unset($styleArrayBorder);
unset($styleArrayBgm);

//Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Usuario');

//Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteUsuario.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

ob_end_clean();
$objWriter->save('php://output');
exit;
?>