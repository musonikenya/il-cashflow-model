<?php
/*
  This is the main class where the magic happens.
  The all the computation occurs at this point.
*/
namespace App\Cashflow;

use PHPExcel;
use PHPExcel_IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Cashflow; //model
use App\Cashflow\Supportfunctionslibrary;
use App\Cashflow\Cashflowloanlibrary;
use App\Cashflow\Cashflowstatementslibrary;
use App\Cashflow\Cashflowloanhistorylibrary;
use App\Cashflow\Cashflowassetsandliabilitieslibrary;
use App\Cashflow\Cashflowotherinformationlibrary;
use App\Cashflow\Cashflowcropslibrary;
use App\Cashflow\Cashflowanimalslibrary;

class Computecashflowmodel {

    protected $supportFunctions;
    protected $cashflowloanlibrary;
    protected $cashflowstatementslibrary;
    protected $cashflowloanhistorylibrary;
    protected $cashflowassetsandliabilitieslibrary;
    protected $cashflowotherinformationlibrary;
    protected $cashflowcropslibrary;
    protected $cashflowanimalslibrary;

  public function __construct() {
        $this->supportFunctions = new Supportfunctionslibrary;
        $this->cashflowloanlibrary = new Cashflowloanlibrary;
        $this->cashflowloanhistorylibrary = new Cashflowloanhistorylibrary;
        $this->cashflowstatementslibrary = new Cashflowstatementslibrary;
        $this->cashflowassetsandliabilitieslibrary = new Cashflowassetsandliabilitieslibrary;
        $this->cashflowotherinformationlibrary = new Cashflowotherinformationlibrary;
        $this->cashflowcropslibrary = new Cashflowcropslibrary;
        $this->cashflowanimalslibrary = new Cashflowanimalslibrary;

      }
    public function computeCashFlowModel($webHookData = NULL)
      	{
      		/*
      			Using PHPExcel library
      		*/
      		   ini_set('date.timezone', 'UTC'); //setting the default timezone
      			$time = date('H:i:s');  //set the time  for document
      			// Including the timestamp during the
      		$fileName= 'Cashflow_loanid_'. $webHookData['loanId'] .'_pluginId_' . $this->supportFunctions->generateRandomId() . '_' . date('m.d.Y.his') ;
            //  $inputFile = storage_path('app/cash_flow_model_20161004.xlsx');
              $inputFile = public_path('Data/cash_flow_model_20161004.xlsx');
              /**  Identify the type of $inputFileName  **/
              $inputFileType = PHPExcel_IOFactory::identify($inputFile);
              /**  Create a new Reader of the type defined in $inputFileType  **/
              $objReader = PHPExcel_IOFactory::createReader($inputFileType);
              /**  Advise the Reader to load all Worksheets  **/
              $objReader->setLoadAllSheets();
              /**  Load $inputFileName to a PHPExcel Object   **/
              $objPHPExcel = $objReader->load($inputFile);
      		/*
      		Process Json data
      		*/
      		$processLoan = $this->cashflowloanlibrary->receiveCashFlowLoanData($webHookData['loanId']); //get cashflow crop data
      		$processStatements = $this->cashflowstatementslibrary->receiveCashFlowStatementsData($webHookData['loanId']); //get cashflow crop data
      		$processLoanHistory = $this->cashflowloanhistorylibrary->receiveCashFlowLoanHistoryData($webHookData['loanId']); //get cashflow crop data
      		$processAssetsAndLiability = $this->cashflowassetsandliabilitieslibrary->receiveAssetsAndLiabilityData($webHookData['loanId']); //get cashflow crop data
      		$processOtherInformation = $this->cashflowotherinformationlibrary->receiveCashFlowOtherInformationData($webHookData['loanId']); //get cashflow crop data
      		$processCrops = $this->cashflowcropslibrary->receiveCashFlowCropsData($webHookData['loanId']); //get cashflow crop data
      		$processAnimals = $this->cashflowanimalslibrary->receiveCashFlowAnimalsData($webHookData['loanId']); //get cashflow crop data
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      //////////////////////////////////////////////////////////////////////////////////////////////////////
      							/*
      								writing assets and liability data
      							*/
      							$objPHPExcel->getActiveSheet()->setCellValue('B40', $processAssetsAndLiability->landOwnership)
      												->setCellValue('B41', $processAssetsAndLiability->landRent)
      												->setCellValue('B42', $processAssetsAndLiability->landRentPaidMonth)
      												->setCellValue('B43', $processAssetsAndLiability->landLocation)
      												->setCellValue('B44', $processAssetsAndLiability->houseOwnership)
      												->setCellValue('B45', $processAssetsAndLiability->valueHouseFurniture)
      												->setCellValue('B46', $processAssetsAndLiability->valueOtherAssets)
      												->setCellValue('B47', $processAssetsAndLiability->valueStock)
      												->setCellValue('B48', $processAssetsAndLiability->loanInvestment)
      												->setCellValue('B49', $processAssetsAndLiability->cashResource)
      												->setCellValue('B51', $processAssetsAndLiability->totalDebt);
      							/*
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      							/*
      								writing other information data
      								rewrite this function to take into consideration the object
      							*/
      							//rewrite
      									$baseRow = 34; //row number
      												foreach ($processOtherInformation as $arrayKey => $arrayValue) {
      															$row = $baseRow + $arrayKey;
      																					$col = 'A'; //setting row name here
      																					//checking if its an object
      																					if (is_object($arrayValue)) {
      																						$objPHPExcel->getActiveSheet()->setCellValue('B25', $arrayValue->howMuchLabour)
      																											->setCellValue('B29', $arrayValue->activityDescription)
      																											->setCellValue('B30', $arrayValue->monthlyIncome)
      																											->setCellValue('B31', $arrayValue->monthlyExpense);
      																					} else {
      																							foreach ($arrayValue as $key => $value) {
      																									$objPHPExcel->getActiveSheet()->setCellValue($col.$baseRow, $value);
      																									$col++ ;
      																							}
      																					}

      																		$baseRow++ ;
      												}
                              //Write condition that checks if the values have been for the bottom rows.
                          /*
                                if(($objPHPExcel->getActiveSheet()->getCell('B36')->getCalculatedValue() == NULL) && ($objPHPExcel->getActiveSheet()->getCell('B36')->getCalculatedValue() == NULL) )
                                  {
                                    $objPHPExcel->getActiveSheet()->setCellValue('B36', 0)
                                              ->setCellValue('C36', ' ');
                                  }
                          */
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      							/*
      								writing crop data to the model
      								re-wrote this
      							*/
      						//rewrite
      						$baseRow = 7; //row number
      									foreach ($processCrops as $arrayKey => $arrayValue) {
      												$row = $baseRow + $arrayKey;
      																		$col = 'A'; //setting row name here
      																		//checking if its an object
      																				foreach ($arrayValue as $key => $value) {
      																						$objPHPExcel->getActiveSheet()->setCellValue($col.$baseRow, $value);
      																						$col++ ;
      																				}
      															$baseRow++ ;
      									}
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      						// end of foreachloop
      							/*
      								writing Animal data to the model
      								rewrote this function
      							*/
      							//rewrite
      							$baseRow = 19; //row number
      										foreach ($processAnimals as $arrayKey => $arrayValue) {
      													$row = $baseRow + $arrayKey;
      																			$col = 'A'; //setting row name here
      																			//checking if its an object
      																					foreach ($arrayValue as $key => $value) {
      																							$objPHPExcel->getActiveSheet()->setCellValue($col.$baseRow, $value);
      																							$col++ ;
      																					}
      																$baseRow++ ;
      										}
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      							/*	writing loan history data to file
      								History of the lates 5 loans taken
      							*/
      											//rewrite
      											$baseRow = 56; //row number
      														foreach ($processLoanHistory as $arrayKey => $arrayValue) {
      																	$row = $baseRow + $arrayKey;
      																							$col = 'A'; //setting row name here
      																							//checking if its an object
      																									foreach ($arrayValue as $key => $value) {
      																											$objPHPExcel->getActiveSheet()->setCellValue($col.$baseRow, $value);
      																											$col++ ;
      																									}
      																				$baseRow++ ;
      														}
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      							/*
      								writing loan statements data to file
      								Mpesa & bank cash flows (from past statements)
      							*/
      													$baseRow = 66; //row number
      												foreach ($processStatements as $arrayKey => $arrayValue) {
      															$row = $baseRow + $arrayKey;
      																					$col = 'A'; //setting row name here
      																			foreach ($arrayValue as $key => $value) {
      																					$objPHPExcel->getActiveSheet()->setCellValue($col.$baseRow, $value);
      																					$col++ ;
      																			}
      																		$baseRow++ ;
      												}
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      												/*
      													writing loan data
      												*/
      												$objPHPExcel->getActiveSheet()->setCellValue('B75', $webHookData['officeId'])
      																	->setCellValue('B76', $processLoan->submissionDate)
      																	->setCellValue('B79', $processLoan->disbursementDate)
      																	->setCellValue('B80', $processLoan->repaymentDate)
      																	->setCellValue('B81', $processLoan->principalApplied)
      																	->setCellValue('B82', $processLoan->interestRate)
      																	->setCellValue('B83', $processLoan->repaymentFrequency)
      																	->setCellValue('B84', $processLoan->repaymentEvery)
      																	->setCellValue('B85', $processLoan->installmentsNumber)
      																	->setCellValue('B86', $processLoan->gracePrincipal)
      																	->setCellValue('B87', $processLoan->graceInterest);
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                             //Saving the file
                             $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                            // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      											// $objPHPExcel->setActiveSheetIndex(3);
      											// $objWriter->setPreCalculateFormulas(true); //making sure calculation takes place before saving
      											 $objWriter->setPreCalculateFormulas(); //making sure calculation takes place before saving
      					  $createdFolder = $this->supportFunctions->createStorage() . '/';  //adding the slash to point to inside the dir
      					  $savedPath = $createdFolder . $fileName; //joining the created folder and the file name for the path
      						$objWriter->save(str_replace(__FILE__,'./docs/'. $savedPath . '.xlsx',__FILE__));
      						//Getting the file name to be saved in database
      					$savedFilePath = public_path() . 'docs/'.$savedPath. '.xlsx'; //send this to db
      								$cashflowFile['path'] = 'docs/'. $savedPath . '.xlsx'; //returning the file
      								$cashflowFile['savedFilePath'] = $savedFilePath; ////redundunt
      								$cashflowFile['loanId']= $webHookData['loanId'];
      								return $cashflowFile ;
      	}

}
