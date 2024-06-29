<?php
require_once(APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php');
require_once(APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');

$floors = array();
$floor_ids = array();
$towers = array();
$tower_ids = array();
$unit_codes = array();
$unit_code_ids = array();

foreach ($floor_list as $floor) {
	$floors[] = $floor->floor_name;//$floor->floor_id."#".$floor->floor_name; 
	$floor_ids[] = $floor->floor_id; 
}
foreach ($block_list as $item) {
	$towers[] = $item['block_name'];//$item['block_id']."#".$item['block_name']; 
	$tower_ids[] = $item['block_id']; 
}
foreach ($unit_code_list as $unit_code) {
	$unit_codes[] = $unit_code['unit_code'];//$unit_code['unit_code_id']."#".$unit_code['unit_code']; 
	$unit_code_ids[] = $unit_code['unit_code_id']; 
}

$options = array("Yes","No");


/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

/* Create a first sheet, representing sales data*/
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Inventory Id');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Unit Code');
$objValidation = $objPHPExcel->getActiveSheet()->getCell('B1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $unit_codes).'"');

$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Reference');

$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Unit No');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tower');
$objValidation = $objPHPExcel->getActiveSheet()->getCell('E1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $towers).'"'); 

$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Floor');
$objValidation = $objPHPExcel->getActiveSheet()->getCell('F1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $floors).'"'); 

$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Basic Cost');
$objValidation = $objPHPExcel->getActiveSheet()->getCell('G1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');

$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Parking');
$objValidation = $objPHPExcel->getActiveSheet()->getCell('H1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');

$alphas = range('I', 'Z');
$k=0;
foreach ($columns as $record) {

$objPHPExcel->getActiveSheet()->getColumnDimension($alphas[$k])->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue($alphas[$k].'1', $record['name']);//$record['code']."#".$record['name']

$objValidation = $objPHPExcel->getActiveSheet()->getCell($alphas[$k].'1')->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');
	$k++;
}

$i=0;$o=2; foreach($records as $record) { 
	$extra_entry_array = array();

	$data_inv_add = $this->Action_model->detail_result('tbl_inventory_additional',"inventory_id='".$record->inventory_id."'");
	foreach ($data_inv_add as $itemIA) {
		$extra_entry_array['additional_'.$itemIA->product_additional_detail_id] = $itemIA->is_active;
	}

	$data_inv_add = $this->Action_model->detail_result('tbl_inventory_plc',"inventory_id='".$record->inventory_id."'");
	foreach ($data_inv_add as $itemIA) {
		$extra_entry_array['plc_'.$itemIA->product_plc_detail_id] = $itemIA->is_active;
	}

$objPHPExcel->getActiveSheet()->setCellValue('A'.$o, $record->inventory_id);

$option = "";
if(in_array($record->unit_code, $unit_code_ids)) {
	$option = $unit_codes[array_search($record->unit_code,$unit_code_ids)];
}
$objPHPExcel->getActiveSheet()->setCellValue('B'.$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell('B'.$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $unit_codes).'"'); 

$objPHPExcel->getActiveSheet()->setCellValue('C'.$o, trim($record->reference));

$objPHPExcel->getActiveSheet()->setCellValue('D'.$o, $record->unit_no);

$option = "";
if(in_array($record->block_id, $tower_ids)) {
	$option = $towers[array_search($record->block_id,$tower_ids)];
}
$objPHPExcel->getActiveSheet()->setCellValue('E'.$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell('E'.$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $towers).'"'); 

$option = "";
if(in_array($record->floor_id, $floor_ids)) {
	$option = $floors[array_search($record->floor_id,$floor_ids)];
}
$objPHPExcel->getActiveSheet()->setCellValue('F'.$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell('F'.$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $floors).'"'); 

$option = "No";
if($record->basic_cost) {
	$option = "Yes";
}
$objPHPExcel->getActiveSheet()->setCellValue('G'.$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell('G'.$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');

$option = "No";
if($record->parking) {
	$option = "Yes";
}
$objPHPExcel->getActiveSheet()->setCellValue('H'.$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell('H'.$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');

$k=0;
foreach ($columns as $column) {
$option = "No";
if($extra_entry_array && array_key_exists($column['code'], $extra_entry_array) && $extra_entry_array[$column['code']]==1){ $option = "Yes"; }

$objPHPExcel->getActiveSheet()->setCellValue($alphas[$k].$o, $option);
$objValidation = $objPHPExcel->getActiveSheet()->getCell($alphas[$k].$o)->getDataValidation();     
$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
$objValidation->setAllowBlank(false);
$objValidation->setShowInputMessage(true);
$objValidation->setShowErrorMessage(true);
$objValidation->setShowDropDown(true);
$objValidation->setErrorTitle('Input error');
$objValidation->setError('Please choose from dropdown list');
$objValidation->setPromptTitle('Allowed input');
$objValidation->setFormula1('"'.implode(',', $options).'"');
	$k++;
}
$o++;
$i++;
}
/*for ($i=1; $i <= 10; $i++) { 
	$name=1;
	$email=2;
	$objPHPExcel->getActiveSheet()->setCellValue("A".($i+1),$floors[$i-1]);
	$objValidation = $objPHPExcel->getActiveSheet()->getCell("A".($i+1))->getDataValidation();  
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
	$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
	$objValidation->setAllowBlank(false);
	$objValidation->setShowInputMessage(true);
	$objValidation->setShowErrorMessage(true);
	$objValidation->setShowDropDown(true);
	$objValidation->setErrorTitle('Input error');
	$objValidation->setError('Please choose from dropdown list');
	$objValidation->setPromptTitle('Allowed input');
	$objValidation->setFormula1('"'.implode(',', $floors).'"');

	
	$objPHPExcel->getActiveSheet()->setCellValue("B".($i+1),"");//$towers[$i-1]
	$objValidation = $objPHPExcel->getActiveSheet()->getCell("B".($i+1))->getDataValidation();  
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );     
	$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );     
	$objValidation->setAllowBlank(false);
	$objValidation->setShowInputMessage(true);
	$objValidation->setShowErrorMessage(true);
	$objValidation->setShowDropDown(true);
	$objValidation->setErrorTitle('Input error');
	$objValidation->setError('Please choose from dropdown list');
	$objValidation->setPromptTitle('Allowed input');
	$objValidation->setFormula1('"'.implode(',', $towers).'"');
}*/



/*Rename sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Unit Code');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Tower');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Floor');

//while($row1= mysqli_fetch_array($result1)) {
$i=1;
foreach ($unit_codes as $row) {
	$objPHPExcel->getActiveSheet()->setCellValue("A".($i+1),$row);
	$i++;
}
$i=1;
foreach ($towers as $row) {
	$objPHPExcel->getActiveSheet()->setCellValue("B".($i+1),$row);
	$i++;
}
$i=1;
foreach ($floors as $row) {
	$objPHPExcel->getActiveSheet()->setCellValue("C".($i+1),$row);
	$i++;
}

/* Rename 2nd sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Sheet 2');

// Save the spreadsheet
$writer->save('products.xlsx');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ProjectInventory_'.$product_id.'.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');