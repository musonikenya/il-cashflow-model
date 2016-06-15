<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	/*

	public function index()
	{
		$this->load->view('welcome_message');
	}
    */
    public function index()
    {

       // $inputFileType = 'Excel5';
        $inputFile = './docs/flow-demo.xlsx';
        //load the excel library
        $this->load->library('excel');

        /**  Identify the type of $inputFileName  **/
        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader to load all Worksheets  **/
        $objReader->setLoadAllSheets();

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($inputFile);

       //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;
        echo '<pre>';
        print_r($data['values']);
        echo '</pre>';
}
 public function reader()
	{
		//This function reads the jyson file for testing
		$inputFile = './docs/sample_request.json';
		// Read the file contents into a string variable,
			// and parse the string into a data structure
			$str_data = file_get_contents($inputFile);
			$fileContent = json_decode($str_data, true);
			/*echo "<pre>";
			print_r($fileContent);
			echo "</pre>";
			echo "End of file";
			echo "<br>";
			*/
			//Traverse array and get the key and value
			foreach ($fileContent as $key => $value) {
					if (!is_array($value)) {
						echo $key . '=>' . $value . '<br/>';
					} else {
						foreach ($value as $key => $val) {
							//echo $key . '=>' . $val . '<br/>';
							//echo $key . '<br>';
							//echo $val['asset_serial'];
							echo $value['asset_id'];
							echo "<pre>";
							print_r($value);
							echo "</pre>";
						}
					}
				}

			//*/
	}
     public function reader_write()
	{
		/*
			Introduce the PHPExcel Writer
		*/
		    date_default_timezone_set('Europe/London');
			$today = date('Y-m-d');
			$time = date('H:i:s');
		// $inputFileType = 'Excel5';
        $inputFile = './docs/flow-demo.xlsx';
        //load the excel library
        $this->load->library('excel');

        /**  Identify the type of $inputFileName  **/
        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader to load all Worksheets  **/
        $objReader->setLoadAllSheets();

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($inputFile);

		/*
		Process Json data
		*/
		$inputFileJ = './docs/new.json';
			$str_data = file_get_contents($inputFileJ);
			$fileContent = json_decode($str_data, true);
						//while ($fileContent = json_decode($str_data, true)) { //rewrite this loop
						//Setting Variables for the file
                           $baseRow = 6;
						   $fileName= 'Flow-demo-Output';//$resfor=$dataname['name'];
						//foreach loop to write data to file
						   foreach($fileContent as $r => $dataRow) {
									if (!is_array($dataRow)) {
										//echo $key . '=>' . $value . '<br/>';
										echo 'could not write to file';
										exit;
									} else {
								   $row = $baseRow + $r;
								  // $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
								   $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $dataRow['crop'])
														 ->setCellValue('B'.$row, $dataRow['acer'])
														 ->setCellValue('C'.$row, $dataRow['cropping'])
														 ->setCellValue('D'.$row, $dataRow['hybrid'])
														 ->setCellValue('E'.$row, $dataRow['fertilizer'])
														 ->setCellValue('F'.$row, $dataRow['pesticides'])
														 ->setCellValue('G'.$row, $dataRow['month'])
														 ->setCellValue('H'.$row, $dataRow['consume'])
														 ->setCellValue('I'.$row, $dataRow['storing']);
								   }  // end of foreachloop
						   }
                       //Saving the file
                       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					   //echo 'I got here';
					   //$objWriter->save('./docs/fin.xls');
					   //exit;
                       $objWriter->save(str_replace(__FILE__,'./docs/'.$fileName . '.xlsx',__FILE__));
                       //$objWriter->save(str_replace('.php', '.xls', __FILE__));
                       echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
                        echo 'Done';
                       echo date('H:i:s') , " Done writing file";
                //}

	}
	public function reader_write_new()
{
 /*
	 Introduce the PHPExcel Writer
 */
		 date_default_timezone_set('Europe/London');
	 	 $today = date('Y-m-d');
		 $time = date('H:i:s');
 // $inputFileType = 'Excel5';
		 $inputFile = './docs/flow-demo.xlsx';
		 //load the excel library
		 $this->load->library('excel');
		 /**  Identify the type of $inputFileName  **/
		 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
		 /**  Create a new Reader of the type defined in $inputFileType  **/
		 $objReader = PHPExcel_IOFactory::createReader($inputFileType);

		 /**  Advise the Reader to load all Worksheets  **/
		 $objReader->setLoadAllSheets();
		// $sheetList = $objReader->listWorksheetNames($inputFileName);
		 /**  Load $inputFileName to a PHPExcel Object  **/
		 $objPHPExcel = $objReader->load($inputFile);

		 // makes the sheet 'data' available as an object
      //  $sheet = $objPHPExcel->getSheetByName("Inputs");
		// $sheetList = $objReader->listWorksheetNames($inputFileName);

		//	echo "<pre>";
		 //	print_r($sheet);
		//	echo "</pre>";
		// exit;
 /*
 Process Json data
 */
 $inputFileJ = './docs/new.json';
	 $str_data = file_get_contents($inputFileJ);
	 $fileContent = json_decode($str_data, true);
				 //while ($fileContent = json_decode($str_data, true)) { //rewrite this loop
				 //Setting Variables for the file
												$baseRow = 6; //setting row to beging writing data from
						$fileName= 'Loan demo';//$resfor=$dataname['name'];
				 //foreach loop to write data to file
				 // Set cell A1 with a string value
				 //$sheet->setCellValue('F3', 'NO');
				 $objPHPExcel->getActiveSheet()->setCellValue('F3','NO');

				 // Set cell A2 with a numeric value
				// $objPHPExcel->getActiveSheet()->setCellValue('A2', 12345.6789);

										//Saving the file
										$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					//echo 'I got here';
					//$objWriter->save('./docs/fin.xls');
					//exit;
					$objWriter->setPreCalculateFormulas(false);
										$objWriter->save(str_replace(__FILE__,'./docs/'.$fileName . '.xlsx',__FILE__));
										//$objWriter->save(str_replace('.php', '.xls', __FILE__));
										echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
										 echo 'Done';
										echo date('H:i:s') , " Done writing file";
						 //}

}
public function read_save()
{
/*
 Introduce the PHPExcel Writer
*/
	 date_default_timezone_set('Europe/London');
	 $today = date('Y-m-d');
	 $time = date('H:i:s');
	 $fname = 'Cash-flow-Output-';
// $inputFileType = 'Excel5';
	 $inputFile = './docs/cash-flow-model.xlsx';
	 //name the final file
	 $fileName = $fname;
	 //load the excel library
	 $this->load->library('excel');
	 /**  Identify the type of $inputFileName  **/
	 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
	 /**  Create a new Reader of the type defined in $inputFileType  **/
	 $objReader = PHPExcel_IOFactory::createReader($inputFileType);

	 /**  Advise the Reader to load all Worksheets  **/
	 $objReader->setLoadAllSheets();
	// $sheetList = $objReader->listWorksheetNames($inputFileName);
	 /**  Load $inputFileName to a PHPExcel Object  **/
	 $objPHPExcel = $objReader->load($inputFile);

	 // Write data to the file
	 $objPHPExcel->getActiveSheet()->setCellValue('F3','NO')
	 																->setCellValue('B6', 10)
																	->setCellValue('A9', 'Cabbages')
																	->setCellValue('A25', 'Cows (dairy)');
									//Saving the file
									$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
										//echo 'I got here';
										//$objWriter->save('./docs/fin.xls');
										//exit;
									//	$objWriter->setPreCalculateFormulas(false);
															$objWriter->save(str_replace(__FILE__,'./docs/'. $fileName.  '.xlsx',__FILE__));
															//$objWriter->save(str_replace('.php', '.xls', __FILE__));
															echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
															echo "<br>";
															 echo 'Done';
															echo date('H:i:s') , " Done writing file";
											 //}

}

}
