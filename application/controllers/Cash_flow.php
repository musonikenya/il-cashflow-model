<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow extends CI_Controller {
public function index()
	{
	    //$this->reader_write(); //call the function that writes and saves the file. subtitute this with the one that receives data from webhook
			$this->retrieve_file_info();
	}
public function receive_data()
{
	/*
			This function is for reciving data from Musoni web hook and saving the request to db
			use twitter API to structure how the notification will be received.
	*/
	$jsonArray = json_decode(file_get_contents('php://input'),true);
}
public function retrieve_file_info()
	{
			$this->load->helper('file');
		$content = get_filenames(APPPATH.'controllers/', true);
			print_r($content);
	}
public function reader_write()
	{
		/*
			Introduce the PHPExcel Writer
		*/
		    date_default_timezone_set('Europe/London');
			$today = date('Y-m-d'); //set the date to be used in saving the file. This has not been implemented yet
			$time = date('H:i:s');  //set the time
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
                       //Set message to be written on the browser to confirm that the file has been written
                       echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
                        echo 'Done';
                       echo date('H:i:s') , " Done writing file";
                //}

	}

}
