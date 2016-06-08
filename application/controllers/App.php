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
        $inputFile = './docs/loan.xls';
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
    
    
}
