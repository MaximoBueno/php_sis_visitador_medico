<?php
/** Incluir la libreria PHPExcel */


error_reporting(0);
$employee_name = $_POST['nombre_empleado'];
$salary = $_POST['salario'];


require_once('../../../PHPExcel/Classes/PHPExcel.php');



//Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//Establecer propiedades
$objPHPExcel->getProperties()
    ->setCreator("Cattivo")
    ->setLastModifiedBy("Cattivo")
    ->setTitle("Documento Excel")
    ->setSubject("Documento Excel de Reporte")
    ->setDescription("Reporte desde PHP (Tesoreria).")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Reportes de Excel");

//Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', $employee_name)
    ->setCellValue('B1', $salary)
    ->setCellValue('C1', 'Total');

//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$i = 2;
for($i = 2; $i < 100; $i++){
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $i)
        ->setCellValue('B'.$i, $i)
        ->setCellValue('C'.$i, $i);
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
$objPHPExcel->getActiveSheet()->getStyle('A1:A'.$i)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$i)->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$i)->applyFromArray($styleArrayBorder);

//Set Color de fondo
$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$i)->getFill()->applyFromArray($styleArrayBgm);

//Eliminando Variables
unset($styleArrayBorder);
unset($styleArrayBgm);

//Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte Exitoso');

//Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>