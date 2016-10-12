<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Generatefinancialsummary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $this->CI->load->library('cashflowdropdownslibrary');
      //  $CI->load->helper('myhelper');
      }
  public function generateFinancialSummary($cashflowFile)
    	{
    		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    																				//Financial Summary Data
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    		ini_set('date.timezone', 'UTC'); //setting the default timezone
    	 $time = date('H:i:s');  //set the time  for document
    		 $inputFile = $cashflowFile['path'];
    		 /**  Identify the type of $inputFileName  **/
    			 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
    		 /**  Create a new Reader of the type defined in $inputFileType  **/
    			 $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		 /**  Advise the Reader to load all Worksheets  **/
    				 $objReader->setLoadAllSheets();

    			 $objPHPExcel = $objReader->load($inputFile);
    						 $sheet = $objPHPExcel->setActiveSheetIndex(0);
    						 $cashflowResultData['loanId']= $cashflowFile['loanId'];
    						 $cashflowResultData['realFilePath']= realpath($inputFile);
    						 $cashflowResultData['savedFilePath']= $cashflowFile['savedFilePath']; //redundunt
    						 $cashflowResultData['path']= $cashflowFile['path']; //redundunt

    								$cashflowResultData['summary']=	 array(
    																				"locale" => "en_GB",
    																		    "dateFormat" => "YYYY-mm-dd",
    																		    "loan_id" => $cashflowFile['loanId'],
    																		    "Crops_planted" => $sheet->getCell('C6')->getCalculatedValue(),
    																		    "Animals_farmed" => $sheet->getCell('C7')->getCalculatedValue(),
    																		    "Other_income" => $sheet->getCell('C8')->getCalculatedValue(),
    																		    "Month_by_when_installment_size_ratio_60" => $sheet->getCell('C12')->getCalculatedValue(),
    																		    "Month_of_minimum_cashflow" => $sheet->getCell('C19')->getCalculatedValue(),
    																		    "Month_of_maximum_cashflow" => $sheet->getCell('C21')->getCalculatedValue(),
    																		    "Approval_recommendations" => $sheet->getCell('C2')->getCalculatedValue(),
    																		    "Installment_amount_after_grace_periods" => $sheet->getCell('C16')->getCalculatedValue(),
    																		    "Loan_size_ratio2" => $sheet->getCell('C11')->getCalculatedValue(),
    																		    "Indebtness_ratio_2" => round($sheet->getCell('C13')->getCalculatedValue(), 2 ,PHP_ROUND_HALF_UP ),
    																		    "Total_yearly_cash_flow_2" => round($sheet->getCell('C17')->getCalculatedValue(), 2),
    																		    "Minimum_monthly_cash_flow_2" => round($sheet->getCell('C18')->getCalculatedValue(), 2),
    																		    "Average_loan_borrowed_in_the_past_2" => $sheet->getCell('C24')->getCalculatedValue(),
    																		    "Max_loan_borrowed_in_the_past_2" => $sheet->getCell('C25')->getCalculatedValue(),
    																		    "Has_always_repaid_in_time_2" => $sheet->getCell('C26')->getCalculatedValue(),
    																				//confirm
    																			//	"Maximum_monthly_cash_flow_2" => round($sheet->getCell('C20')->getCalculatedValue(), 2),
    																		  );

    												 return $cashflowResultData;                          
    	}
}
