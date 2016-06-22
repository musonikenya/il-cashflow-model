<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow extends CI_Controller {
	
	public function __construct()
        {
                // Call the CI_Controller constructor
                parent::__construct();
				$this->load->model('Cash_flow_model', 'CashFlow');
						$this->load->helper('url');
						        //load the excel library
				$this->load->library('excel');
        }
		
public function index()
	{
	    $this->reader_write(); //call the function that writes and saves the file. subtitute this with the one that receives data from webhook
		//	$this->_create_storage();
		//$methods = get_class_methods('CI_Controller');
		//print_r ($methods);
	}
public function receive_data()
{
	/*
			This function is for reciving data from Musoni web hook and saving the request to db
			use twitter API to structure how the notification will be received.
	*/
	$jsonArray = json_decode(file_get_contents('php://input'),true);
}

public function reader_write()
	{
		/*
			Introduce the PHPExcel Writer
		*/
		   // date_default_timezone_set('Europe/London');
		   ini_set('date.timezone', 'UTC'); //setting the default timezone
			$time = date('H:i:s');  //set the time
		// $inputFileType = 'Excel5';
        $inputFile = './docs/flow-demo.xlsx';
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
						    // Including the timestamp during the 
						   $fileName= 'Flow-demo-Output - ' . date('m-d-Y_his') ;//$resfor=$dataname['name'];
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
					   /*
						Calling the function to create folder based on date. if it does not run successfully, the script terminates.
					   */
					  $createdFolder = $this->_create_storage() . '/';  //adding the slash to point to inside the dir
					  $savedPath = $createdFolder . $fileName; //joining the created folder and the file name for the path
					   
                  //  $objWriter->save(str_replace(__FILE__,'./docs/'. $createdFolder . $fileName . '.xlsx',__FILE__));
				  $objWriter->save(str_replace(__FILE__,'./docs/'. $savedPath . '.xlsx',__FILE__));
						//Getting the file name to be saved in database
					$savedFilePath = base_url() . 'docs/'.$savedPath. '.xlsx';
								$this->CashFlow->save_file($savedFilePath);			
				   echo $savedFilePath; //remove this line later on
				   echo '<br>';
                       //$objWriter->save(str_replace('.php', '.xls', __FILE__));
                       //Set message to be written on the browser to confirm that the file has been written
                       echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
                        echo 'Done';
                       echo date('H:i:s') , " Done writing file";
                //}

	}
	private function _create_storage()
	{
		/*
		* This function is for creating folders organized by date for the storage of files
		call this function before any file created to set the dependencies 
		*/ 
		$today = date('Y-m-d'); //setting the date	
		if (!is_dir('docs'))
			{
				mkdir('./docs', 0777, true); //creating the folder docs if it does not already exist
			}
		if (!is_dir('docs/' . $today))
			{
				//creating folder based on day if it does not exist. If it does, it is not created
				// mkdir('./docs/' . $today, 0777, true); 
				if (!mkdir('./docs/' . $today, 0777, true)) {
							die('Failed to create folders...'); // Die if the function mkdir cannot run
					}
				return $today;
			} elseif (is_dir('docs/' . $today)){ //check if the folder is created and return it
				return $today;
			} else {
				return $today; 				// Return the folder if its already created in the file system
				//echo 'folder already exists';
			}
	}
}
