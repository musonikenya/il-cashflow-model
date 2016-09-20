<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
        }
public function index()
	{
// Report all errors except E_WARNING
//error_reporting(E_ALL & ~(E_WARNING | E_NOTICE));
/*
{"officeId":10,"clientId":1309,"loanId":152847,"resourceId":152847} ->Webhook post notification
CREATE TABLE `cash-flow`.`post_notification`
( `id` INT NULL AUTO_INCREMENT , `officeId` INT NULL , `clientId` INT NULL , `loanId` INT NULL ,
 `resourceId` INT NULL , `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
 `processed` BOOLEAN NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
*/

			$webhookPost = file_get_contents("php://input");
							if(isset($webhookPost))
									{
										$notification = json_decode($webhookPost);
										http_response_code(200); //ok

										$this->load->helper('file');

												if ( !write_file('./docs/hookPosts-true.txt', $webhookPost . '\r\n', 'w+')){
																	// echo 'Unable to write the file';
						 										 $data['msg'] = 'Failed. Unable to write data to file';
						 										write_file('./docs/write-fail.txt', $data . "\r\n", 'w+');
															}
															$webHookData = array(
																'officeId' => $notification->officeId,
																'clientId' => $notification->clientId,
																'loanId' => $notification->loanId,
																'resourceId' => $notification->resourceId,
																'processed' => 0,
																'timestamp' => date('Y-m-d H:i:s')
															);
															$accessArray =	$this->CashFlow->webHookRecord($data); //saving the data to db
															write_file('./docs/hookPosts-Processed-2.txt', $data . "\r\n", 'w+');
																		//Processing application
															$cashflowFile =	$this->computeCashFlowModel($webHookData);
															$cashflowSummaryData = 	$this->generateFinancialSummary($cashflowFile); //getting the summary
															$summarystatus =	$this->postFinancialSummary($cashflowSummaryData); //posting financial summary
									}else {
										http_response_code(204); //no content
									}
/*
This block is to be used in testing the flow of data
					$webHookData = array(
									'loanId' => 152878,
									'officeId' => 10,
								);

								$startTime = microtime(true);
								$cashflowFile =	$this->computeCashFlowModel($webHookData);
								$cashflowSummaryData = 	$this->generateFinancialSummary($cashflowFile); //getting the summary
										$summarystatus =	$this->postFinancialSummary($cashflowSummaryData);
								echo "<pre>";
								print_r(json_decode($summarystatus));
								echo "</pre>";
								echo "Reached here <br>";
								echo "Elapsed time is: ". (microtime(true) - $startTime) ." seconds";
							//	exit;
							//	$summarystatus =	$this->postFinancialSummary($status);
	*/
	}
	function postFinancialSummary($cashflowSummaryData)
{
							$data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/" . $cashflowSummaryData['loanId'] ;
					$data['postData'] = json_encode($cashflowSummaryData['summary']);
				//	$data['postData'] = $cashflowSummaryData['summary'];
				//	echo "<br>";
				//	print_r($data['postData']);
				//	echo "<br>";
				//	echo "<pre>";
				//	print_r($data);
				//	echo "</pre>";
				//	exit;

							$result =	$this->cashflowlibrary->curlPostData($data); //uploading data
						//	return $result;
}
function uploadCashflowModel()
{

							$data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/25280/documents/?tenantIdentifier=kenya";

							$filePath = realpath('./docs/2016-09-01/Flow-demo-Output - 09-01-2016_061747.xlsx');
									$data['postData'] =			json_encode(
																					array(
																						'name' => 'image_CashflowModel',
																						'appTableId' => '25280',
																						'locale' => 'en',
																						'file' =>  new CurlFile($filePath) ,

																					)
																				);
																				$feedback =	$this->cashflowlibrary->curlUploadFile($data); //sending the file
	echo "<pre>";
	print_r($feedback);
	echo "<br>";
//	var_dump($feedback);
	echo "</pre>";

}
public function receiveCashFlowYesNoAlternateDropdownData($option = NULL)
	{
		$urlExtention = "/codes/146/codevalues/" . $option; //get the loan ID from the webhook post
			return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowPercentageDropdownData($option = NULL)
	{
		$urlExtention = "/codes/147/codevalues/" . $option; //get the loan ID from the webhook post
			return $this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowSourceSeedsDropdownData($option = NULL)
	{
		$urlExtention = "/codes/154/codevalues/" . $option; //get the loan ID from the webhook post
			return $this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowMonthDropdownData($option = NULL)
	{
		$urlExtention = "/codes/149/codevalues/" . $option; //get the loan ID from the webhook post
			return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowLandLocationDropdownData($option = NULL)
	{
		$urlExtention = "/codes/152/codevalues/" . $option; //get the loan ID from the webhook post
			return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowYesNoDropdownData($option = NULL)
	{
		$urlExtention = "/codes/5/codevalues/" . $option ; //get the loan ID from the webhook post
			return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowFertilizersYesNoDropdownData($option = NULL)
	{
		$urlExtention = "/codes/150/codevalues/" . $option; //get the loan ID from the webhook post
			return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowIrrigationYesNoDropdownData($option = NULL)
	{
		$urlExtention = "/codes/151/codevalues/" . $option; //get the loan ID from the webhook post
		return	$this->cashflowlibrary->curlOption($urlExtention);
	}
public function receiveCashFlowAnimalDropdownData($option = NULL)
		{
			$urlExtention = "/codes/145/codevalues/" . $option; //get the loan ID from the webhook post
				return	$this->cashflowlibrary->curlOption($urlExtention);
		}
public function receiveCashFlowCropDropdownData($option = NULL)
		{
			$urlExtention = "/codes/144/codevalues/" . $option; //get the loan ID from the webhook post
				return	$this->cashflowlibrary->curlOption($urlExtention);
		}
	public function receiveCashFlowLoanData($loanId = NULL)
	{
		/*
					Processing data from loan call for cash flow
					data not available is the branch
					The details echoéd are the ones to be entered in the excel model
		*/
				$urlExtention = "/loans/" . $loanId; //get the loan ID from the webhook post
				$CashFlowLoan =	$this->cashflowlibrary->curlOption($urlExtention);

							 $loan = array(
								 'submissionDate' => $CashFlowLoan['timeline']['submittedOnDate']['0'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['1'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['2'],
								 'disbursementDate' => $CashFlowLoan['timeline']['expectedDisbursementDate']['0'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['1'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['2'],
								 'repaymentDate' => $CashFlowLoan['expectedFirstRepaymentOnDate']['0'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['1'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['2'],
								 'principalApplied' => $CashFlowLoan['principal'],
								 'interestRate' => $CashFlowLoan['interestRatePerPeriod'],
								 'repaymentFrequency' => $CashFlowLoan['termPeriodFrequencyType']['value'],
								 'repaymentEvery'	=> $CashFlowLoan['repaymentEvery'],
								 'installmentsNumber' => $CashFlowLoan['termFrequency'],
								 'gracePrincipal' => $CashFlowLoan['graceOnPrincipalPayment'],
								 'graceInterest' => $CashFlowLoan['graceOnInterestPayment']
							 );
							 return (object)$loan;
	}
public function receiveCashFlowStatementsData($loanId = NULL)
	{
			/*
				Processing statement data
			*/
			$urlExtention = "/datatables/cct_CashFlowStatements/" . $loanId; //get the loan ID from the webhook post
				$CashFlowStatements =	$this->cashflowlibrary->curlOption($urlExtention);
				//row 1
						$month1 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_1']); //dropdown month
						$row1Statements = array(
										'month'=> $month1['name'],
										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_1'],
										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_1'],
									);
				//row 2
						$month2 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_2']); //dropdown month
						$row2Statements = array(
										'month'=> $month2['name'],
										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_2'],
										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_2'],
									);
				//row 3
								$month3 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_3']); //dropdown month
					$row3Statements = array(
									'month'=> $month3['name'],
									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_3'],
									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_3'],
								);
				//row 4
									$month4 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_4']); //dropdown month
						$row4Statements = array(
										'month'=> $month4['name'],
										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_4'],
										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_4'],
									);
				//row 5
							$month5 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_5']); //dropdown month

						$row5Statements = array(
										'month'=> $month5['name'],
										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_5'],
										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_5'],
									);
				//row 6
								$month6 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_6']); //dropdown month
					$row6Statements = array(
									'month'=> $month6['name'],
									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_6'],
									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_6'],
								);
								$statements = array($row1Statements,$row2Statements,$row3Statements,$row4Statements,$row5Statements,$row6Statements);
									return $statements;

	}
	public function receiveCashFlowLoanHistoryData($loanId = NULL)
		{
			/*
				Processing loan history data
			*/
			$urlExtention = "/datatables/cct_Loanhistory/" . $loanId; //get the loan ID from the webhook post
				$cashflowLoanHistory =	$this->cashflowlibrary->curlOption($urlExtention);
								$clientLoanHistory = array();
			//Loan 1
		//	"YesNo_cd_Add_a_loan": "243"
					//Checking if the first loan option is selected
				if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_loan'] == 243 ) {
						$timelyRepayment1 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_1']); //dropdown yesno
									$loan1History = array(
									'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_1'],
									'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_1'],
									'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_1']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['2'],
									'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_1'],
									'timelyPayments' => $timelyRepayment1['name'],
									'loanComment' => $cashflowLoanHistory['0']['Comments_loan_1'],
								);
									//	return $loanHistory;
													//Checking if the second loan option is selected
										if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_second_loan'] == 243) {
											//row 2
													//"YesNo_cd_Add_a_second_loan": "243",
												$timelyRepayment2 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_2']); //dropdown yesno
												$loan2History = array(
																	'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_2'],
																	'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_2'],
																	'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_2']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['2'],
																	'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_2'],
																	'timelyPayments' => $timelyRepayment2['name'],
																	'loanComment' => $cashflowLoanHistory['0']['Comments_loan_2'],
																);

																//Checking if the third loan option is selected
																if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_third_loan'] == 243) {
																				//row 3
																				//	"YesNo_cd_Add_a_third_loan": "243",
																	$timelyRepayment3 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_3']); //dropdown yesno
																				$loan3History = array(
																						'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_3'],
																						'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_3'],
																						'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_3']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['2'],
																						'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_3'],
																						'timelyPayments' => $timelyRepayment3['name'],
																						'loanComment' => $cashflowLoanHistory['0']['Comments_loan_3'],
																					);

																						//Checking if the fourth loan option is selected
																							if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fourth_loan'] == 243) {
																											//row 4
																												//	"YesNo_cd_Add_a_fourth_loan": "243",
																									$timelyRepayment4 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_4']); //dropdown yesno
																									$loan4History = array(
																													'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_4'],
																													'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_4'],
																													'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_4']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['2'],
																													'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_4'],
																													'timelyPayments' => $timelyRepayment4['name'],
																													'loanComment' => $cashflowLoanHistory['0']['Comments_loan_4'],
																												);

																												//Checking if the fifth loan option is selected
																														if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fifth_loan'] == 243) {
																																	//row 5
																																	//	"YesNo_cd_Add_a_fifth_loan": "243",
																																	$timelyRepayment5 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_5']); //dropdown yesno
																																	$loan5History = array(
																																					'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_5'],
																																					'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_5'],
																																					'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_5']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['2'],
																																					'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_5'],
																																					'timelyPayments' => $timelyRepayment5['name'],
																																					'loanComment' => $cashflowLoanHistory['0']['Comments_loan_5'],
																																				);
																																				////if all the 5 loan has also been entered
																																				//return both loan1, loan 2, loan 3, loan 4 and loan 5
																																						$clientLoanHistory = array($loan1History, $loan2History, $loan3History, $loan4History, $loan5History );
																																						return $clientLoanHistory;

																														} else {
																															//if the fourth loan has also been entered
																															//return both loan1, loan 2, loan 3 and loan 4
																																	$clientLoanHistory = array($loan1History, $loan2History, $loan3History, $loan4History );
																																	return $clientLoanHistory;
																														}
																							} else {
																								//if the third loan has also been entered
																								//return both loan1, loan 2 and loan 3
																									$clientLoanHistory = array($loan1History, $loan2History, $loan3History );
																									return $clientLoanHistory;
																							}

																} else {
																	//if the second loan has also been entered
																	//return both loan1 and loan 2
																		$clientLoanHistory = array($loan1History, $loan2History );
																		return $clientLoanHistory;
																}

										} else {
													//only the first loan is entered return the feedback
												$clientLoanHistory = array($loan1History);
												return $clientLoanHistory;
										}

				}else {
					# code...
					//write code here that stops processing of information if there is no data to be processed
								$clientLoanHistory = array();
								return $clientLoanHistory;
				}

		}

	public function receiveAssetsAndLiabilityData($loanId = NULL)
	{
			/*
				Processing assets and liabilities data
			*/
			$urlExtention = "/datatables/cct_CashFlowAssetsandLiabilities/" . $loanId; //get the loan ID from the webhook post
				$cashflowAssetsAndLiabilities =	$this->cashflowlibrary->curlOption($urlExtention);
									$landYours =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_land_yours']); //dropdown yesno
							$landlocation =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['Cashflow_LandLocation_cd_Land_location']); //dropdown landlocation
							$houseYours =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_house_yours']); //dropdown yesno


							$AssetsAndLiabilities = array(
								'landOwnership'=> $landYours['name'],
								'landLocation'=> $landlocation['name'],
								'houseOwnership'=> $houseYours['name'],
								'valueHouseFurniture'=> $cashflowAssetsAndLiabilities['0']['Value_of_house_and_furniture'],
								'valueOtherAssets'=> $cashflowAssetsAndLiabilities['0']['Value_other_assets_s'],
								'valueStock'=> $cashflowAssetsAndLiabilities['0']['Value_stock_and_inventory'],
								'loanInvestment'=> $cashflowAssetsAndLiabilities['0']['With_this_loan_are_y'],
								'cashResource'=> $cashflowAssetsAndLiabilities['0']['Cash_available_from'],
								'totalDebt'=> $cashflowAssetsAndLiabilities['0']['Debts_with_friends_other_people'],
								'landRent'=> $cashflowAssetsAndLiabilities['0']['Land_rent_amount_per_year'],
								'landRentPaidMonth'=> $cashflowAssetsAndLiabilities['0']['Cashflow_Month_cd_Month_when_land_rent_is_paid'], //month dropdown
							);
					return (object)$AssetsAndLiabilities;
	}
	public function receiveCashFlowOtherInformationData($loanId = NULL)
	{
			/*
				Processing Other information data
			*/
			$urlExtention = "/datatables/cct_CashFlowOtherInfo/" . $loanId; //get the loan ID from the webhook post
				$CashFlowOtherInformation =	$this->cashflowlibrary->curlOption($urlExtention);

					$percentage =		$this->receiveCashFlowPercentageDropdownData($CashFlowOtherInformation['0']['Cashflow_Percentage_cd_Labor_carried_out_pe']); //dropdown month
					$mandatoryOtherInfo = array(
													'howMuchLabour' => $percentage['name'],
													'activityDescription' => $CashFlowOtherInformation['0']['Non_farming_activities_description'],
													'monthlyIncome' => $CashFlowOtherInformation['0']['Monthly_income_other_activities'],
													'monthlyExpense' => $CashFlowOtherInformation['0']['Monthly_expenditures_other_activities'],
												);
											//checking if other investment option is set
							if ($CashFlowOtherInformation['0']['YesNo_cd_Add_an_investment'] == 243) {
													//row 1
												//	"YesNo_cd_Add_an_investment": "243",
												$month1 =		$this->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment']); //dropdown month
												$investment1 = array(
																			'investmentType' => $CashFlowOtherInformation['0']['Type_of_investment'],
																			'investmentAmount' => $CashFlowOtherInformation['0']['Investment_amount'],
																			'investmentMonth' => $month1['name'],
																		);
											//checking if a second investment is selected

														if ($CashFlowOtherInformation['0']['YesNo_cd_Add_an_investment'] == 243) {
																				//row 2
																				//		"YesNo_cd_Add_a_second_investment": "243",
																			$month2 =		$this->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment_2']); //dropdown month
																			$investment2 = array(
																										'investmentType' => $CashFlowOtherInformation['0']['investment_2_Type_of_Investment'],
																										'investmentAmount' => $CashFlowOtherInformation['0']['Investment_2_amount'],
																										'investmentMonth' => $month2['name'],
																									);

																									//if the second investment is set
																									//return both the mandatory field and both investments
																									$otherInformationData = array((object)$mandatoryOtherInfo, $investment1, $investment2);
																									return  $otherInformationData;
														} else {
															//if optional investment is set
															//return both the mandatory field and the first option
																	$otherInformationData = array((object)$mandatoryOtherInfo, $investment1);
																	return  $otherInformationData;
														}
							} else {
								//if optional investment is not set just return the mandatory fields
									$otherInformationData = (object)$mandatoryOtherInfo;
									return  $otherInformationData;
							}
}

public function receiveCashFlowAnimalsData($loanId = NULL)
{
		/*
			Processing Crops data
		*/
		$urlExtention = "/datatables/cct_CashFlowAnimals/" . $loanId; //get the loan ID from the webhook post
			$cashflowAnimals =	$this->cashflowlibrary->curlOption($urlExtention);

			//checking if option to add an animal is selected
			if ($cashflowAnimals['0']['YesNo_cd_Please_select_the_ma'] == 243) {
				# code...
				//row 1
			//	"YesNo_cd_Please_select_the_ma": "243",
							$animal =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type']); //dropdown animal
							$breed =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal']); //dropdown yesno
							$purchase =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal']); //dropdown yesnoalternative
							$percentage1 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home']); //dropdown month
							$percentage2 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home']); //dropdown month
									$row1animal = array(
										'animalName' => $animal['name'],
										'animalType' => $cashflowAnimals['0']['Specify_animal'],
										'totalAnimal' => $cashflowAnimals['0']['Total_number_of_animals'],
										'animalProductingEggsMilk' => $cashflowAnimals['0']['Number_of_animals_in'],
										'animalSoldYear' => $cashflowAnimals['0']['Animals_sold_year_animal'],
										'useBreeding' => $breed['name'],
										'priceAnimalSold' => $cashflowAnimals['0']['Price_animal_sold_animal'],
										'otherCostsPerMonth' => $cashflowAnimals['0']['Feeds__labour__veterinary_costs_month'],
										'feedPurchaseFood' => $purchase['name'],
										'milkEggProduced' => $percentage1['name'],
										'animalEatSlaughter' => $percentage2['name'],
										'animalAge' => $cashflowAnimals['0']['Age_of_animals_animal_1'],
									);

							//checking if the second animal is selected
								if ($cashflowAnimals['0']['YesNo_cd_Add_Animal_Type_2'] == 243) {
													//row 2
														//			"YesNo_cd_Add_Animal_Type_2": "243",
																$animal =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_2__Animal_Type']); //dropdown animal
																$breed =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure']); //dropdown yesno
																$purchase =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal']); //dropdown yesnoalternative
																$percentage1 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs']); //dropdown month
																$percentage2 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima']); //dropdown month
																		$row1animal2 = array(
																			'animalName' => $animal['name'],
																			'animalType' => $cashflowAnimals['0']['Specify_animal_2'],
																			'totalAnimal' => $cashflowAnimals['0']['Animal_Type_2__Total_number_of_animals'],
																			'animalProductingEggsMilk' => $cashflowAnimals['0']['Animal_Type_2__Numbe'],
																			'animalSoldYear' => $cashflowAnimals['0']['Animals_sold_year_animal_2'],
																			'useBreeding' => $breed['name'],
																			'priceAnimalSold' => $cashflowAnimals['0']['Price_animal_sold_animal_2'],
																			'otherCostsPerMonth' => $cashflowAnimals['0']['Feedslabourveterinary_costs_month'],
																			'feedPurchaseFood' => $purchase['name'],
																			'milkEggProduced' => $percentage1['name'],
																			'animalEatSlaughter' => $percentage2['name'],
																			'animalAge' => $cashflowAnimals['0']['Age_of_animals_animal_2'],
																		);
													//Checking if a third animal is selected
													if ($cashflowAnimals['0']['YesNo_cd_Add_Animal_Type_3'] == 243) {
														//row 3
													//	"YesNo_cd_Add_Animal_Type_3": "243",
																	$animal =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_3__Animal_Type']); //dropdown animal
																	$breed =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure']); //dropdown yesno
																	$purchase =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal']); //dropdown yesnoalternative
																	$percentage1 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm']); //dropdown month
																	$percentage2 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima']); //dropdown month
																			$row1animal3 = array(
																				'animalName' => $animal['name'],
																				'animalType' => $cashflowAnimals['0']['Specify_animal_3'],
																				'totalAnimal' => $cashflowAnimals['0']['Animal_Type_3__Total_number_of_animals'],
																				'animalProductingEggsMilk' => $cashflowAnimals['0']['Animal_Type_3__Numbe'],
																				'animalSoldYear' => $cashflowAnimals['0']['Animals_sold_year_animal_3'],
																				'useBreeding' => $breed['name'],
																				'priceAnimalSold' => $cashflowAnimals['0']['Price_animal_sold_animal_3'],
																				'otherCostsPerMonth' => $cashflowAnimals['0']['Feedslabourveterinar'],
																				'feedPurchaseFood' => $purchase['name'],
																				'milkEggProduced' => $percentage1['name'],
																				'animalEatSlaughter' => $percentage2['name'],
																				'animalAge' => $cashflowAnimals['0']['Age_of_animals_animal_3'],
																			);

																			//if all the animals have been captured
																			//return all the 3 animals
																			$animals = array($row1animal, $row1animal2, $row1animal3);
																			return $animals;
													} else {
														//if only the first 2 animals are captured
														$animals = array($row1animal, $row1animal2);
														return $animals;
													}

								} else {
									//if only the first animal is captured
									$animals = array($row1animal);
									return $animals;
								}
			} else {
				//returning an empty arry if no animal is captured
					$animals = array();
					return $animals;
			}
}
public function receiveCashFlowCropsData($loanId = NULL)
{
	/*
			retrieve crops data
	*/
	$urlExtention = "/datatables/cct_CashFlowCrops/" . $loanId; //get the loan ID from the webhook post
		$cashflowCrops =	$this->cashflowlibrary->curlOption($urlExtention);

		//checking if add crop one is selected

		if ($cashflowCrops['0']['YesNo_cd_Add_a_crop'] == 243) {
			//row 1
		//	"YesNo_cd_Add_a_crop": "243",
								$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_1']); //dropdown animal
								$seedSource =		$this->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_1']); //dropdown seed source
								$harvestMonth =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_1']); //month
								$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Use_fertilizers_crop_1']); //dropdown fertilizer
								$pesticides =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Use_pesticides_crop_1']); //dropdown yesno
								$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Irrigation_crop_1']); //dropdown irrigationyesno
								$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_planting_crop_1']); //dropdown month
								$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Home_consumption_crop_1']); //dropdown month
											$row1Crops = array(
																'cropName' => $crop['name'] ,
																'cropType' => $cashflowCrops['0']['Specify_crop_1'],
																'acersUnderProduction' => $cashflowCrops['0']['Acres_under_production_last_year_crop_1'],
																'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amo'],
																'seedSource' => $seedSource['name'], //dropdwon seed source
																'useFertilizer' => $fertilizer['name'],
																'fertilizerAmountUsed' => $cashflowCrops['0']['Number_50_Kg_bags_fe'],
																'usePesticides' => $pesticides['name'],
																'useIrrigation' => $irrigation['name'],
																'plantingMonth' => $month['name'] ,
																'harvestMonth' => $harvestMonth['name'], //dropdown month
																'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_1'],
																'homeConsumption' => $percentage['name'],
																'storageDuration' => $cashflowCrops['0']['Months_storage_crop_1'],
											);
							//checking if the second crop is selected
									if ($cashflowCrops['0']['YesNo_cd_Add_a_second_crop'] == 243) {
										//row 2
									//	"YesNo_cd_Add_a_second_crop": "243",
															$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_2']); //dropdown animal
															$seedSource =		$this->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_2']); //dropdown seed source
															$harvestMonth =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_21']); //month
															$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_2Use_fertilizers_crop_2']); //dropdown fertilizer
															$pesticides =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_2Use_pesticides_crop_2']); //dropdown yesno
															$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_2Irrigation']); //dropdown irrigationyesno
															$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Crop_2Month_planting']); //dropdown month
															$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_2Home_consumption']); //dropdown month
																		$row2Crops = array(
																							'cropName' => $crop['name'] ,
																							'cropType' => $cashflowCrops['0']['Specify_crop_2'],
																							'acersUnderProduction' => $cashflowCrops['0']['Crop_2Acres_under_pr'],
																							'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_2'],
																							'seedSource' => $seedSource['name'], //dropdwon
																							'useFertilizer' => $fertilizer['name'],
																							'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_2Number_50_Kg_b'],
																							'usePesticides' => $pesticides['name'],
																							'useIrrigation' => $irrigation['name'],
																							'plantingMonth' => $month['name'] ,
																							'harvestMonth' => $harvestMonth['name'], //dropdown month
																							'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_2'],
																							'homeConsumption' => $percentage['name'],
																							'storageDuration' => $cashflowCrops['0']['Crop_2Months_storage'],
																		);

													//Checking if the 3rd crop is selected
															if ($cashflowCrops['0']['YesNo_cd_Add_a_third_crop'] == 243) {
																//row 3
															//	"YesNo_cd_Add_a_third_crop": "243",
																					$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_3']); //dropdown animal
																					$seedSource =		$this->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_3']); //dropdown seed source
																					$harvestMonth =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_3']); //month
																					$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_3Use_fertilizers_crop_3']); //dropdown fertilizer
																					$pesticides =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_3Use_pesticides_crop_3']); //dropdown yesno
																					$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_3Irrigation_crop_3']); //dropdown irrigationyesno
																					$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Crop_2Month_planting']); //dropdown month
																					$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_3Home_consumption_crop_3']); //dropdown month
																								$row3Crops = array(
																													'cropName' => $crop['name'] ,
																													'cropType' => $cashflowCrops['0']['Specify_crop_3'],
																													'acersUnderProduction' => $cashflowCrops['0']['Crop_3Acres_under_pr'],
																													'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_3'],
																													'seedSource' => $seedSource['name'], //dropdwon
																													'useFertilizer' => $fertilizer['name'],
																													'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_3Number_50_Kg_b'],
																													'usePesticides' => $pesticides['name'],
																													'useIrrigation' => $irrigation['name'],
																													'plantingMonth' => $month['name'] ,
																													'harvestMonth' => $harvestMonth['name'], //dropdown month
																													'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_3'],
																													'homeConsumption' => $percentage['name'],
																													'storageDuration' => $cashflowCrops['0']['Crop_3Months_storage_crop_3'],
																								);

																				//Checking if 4th crop has been added
																					if ($cashflowCrops['0']['YesNo_cd_Add_a_fourth_crop'] == 243) {
																								//row 4
																							//	"YesNo_cd_Add_a_fourth_crop": "243",
																											$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_4']); //dropdown animal
																											$seedSource =		$this->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_4']); //dropdown seed source
																											$harvestMonth =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_4']); //month
																											$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_4Use_fertilizers_crop_4']); //dropdown fertilizer
																											$pesticides =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_4Use_pesticides_crop_4']); //dropdown yesno
																											$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_4Irrigation_crop_4']); //dropdown irrigationyesno
																											$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Crop_4Month_planting_crop_4']); //dropdown month
																											$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_4Home_consumption_crop_4']); //dropdown month
																														$row4Crops = array(
																																			'cropName' => $crop['name'] ,
																																			'cropType' => $cashflowCrops['0']['Specify_crop_4'],
																																			'acersUnderProduction' => $cashflowCrops['0']['Crop_4Acres_under_pr'],
																																			'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_4'],
																																			'seedSource' => $seedSource['name'], //dropdwon
																																			'useFertilizer' => $fertilizer['name'],
																																			'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_4Number_50_Kg_b'],
																																			'usePesticides' => $pesticides['name'],
																																			'useIrrigation' => $irrigation['name'],
																																			'plantingMonth' => $month['name'] ,
																																			'harvestMonth' => $harvestMonth['name'], //dropdown month
																																			'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_4'],
																																			'homeConsumption' => $percentage['name'],
																																			'storageDuration' => $cashflowCrops['0']['Crop_4Months_storage_crop_4'],
																														);

																									//checking if the 5th crop is added
																										if ($cashflowCrops['0']['YesNo_cd_Add_a_fifth_crop'] == 243) {
																												//row 5
																											//	"YesNo_cd_Add_a_fifth_crop": "243",
																																$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_51']); //dropdown animal
																																$seedSource =		$this->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_5']); //dropdown seed source
																																$harvestMonth =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_5']); //month
																																$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_5Use_fertilizers_crop_5']); //dropdown fertilizer
																																$pesticides =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_5Use_pesticides_crop_5']); //dropdown yesno
																																$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_5Irrigation_crop_5']); //dropdown irrigationyesno
																																$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Crop_5Month_planting_crop_5']); //dropdown month
																																$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_5Home_consumption_crop_5']); //dropdown month
																																			$row5Crops = array(
																																								'cropName' => $crop['name'] ,
																																								'cropType' => $cashflowCrops['0']['Specify_crop_5'],
																																								'acersUnderProduction' => $cashflowCrops['0']['Crop_5Acres_under_pr'],
																																								'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_5'],
																																								'seedSource' => $seedSource['name'], //dropdwon
																																								'useFertilizer' => $fertilizer['name'],
																																								'fertilizerAmountUsed' => $cashflowCrops['0']['Number_50_Kg_bags_fe'],
																																								'usePesticides' => $pesticides['name'],
																																								'useIrrigation' => $irrigation['name'],
																																								'plantingMonth' => $month['name'] ,
																																								'harvestMonth' => $harvestMonth['name'] , //dropdown month
																																								'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_5'],
																																								'homeConsumption' => $percentage['name'],
																																								'storageDuration' => $cashflowCrops['0']['Crop_5Months_storage_crop_5'],
																																			);

																														//if all the 5 crops selected, return all of them.
																														$crops = array($row1Crops, $row2Crops, $row3Crops, $row4Crops, $row5Crops);
																														return $crops;
																										} else {
																											//if only 4 crops selected, return them.
																											$crops = array($row1Crops, $row2Crops, $row3Crops, $row4Crops);
																											return $crops;
																										}
																					} else {
																						//if only 1st, 2nd and 3rd crops selected. return the 3 of them.
																						$crops = array($row1Crops, $row2Crops, $row3Crops);
																						return $crops;

																					}
															} else {
																//if only 1st and 2nd crop selected
																//return the 2 of them.
																$crops = array($row1Crops, $row2Crops);
																return $crops;
															}
									} else {
										//if only the 1st crop is selected
										//return it
										$crops = array($row1Crops);
										return $crops;
									}
		} else {
			//if there is no crop selected return an empy accessArray
			$crops = array();
			return $crops;
		}
}

private function computeCashFlowModel($webHookData = NULL)
	{
		/*
			Using PHPExcel library
		*/
		   ini_set('date.timezone', 'UTC'); //setting the default timezone
			$time = date('H:i:s');  //set the time  for document
			// Including the timestamp during the
		$fileName= 'Cashflow_loanid_'. $webHookData['loanId'] .'_pluginId_' . $this->generateRandomId() . '_' . date('m.d.Y.his') ;
		// $inputFileType = 'Excel5';
        $inputFile = './docs/cash_flow_model_20160916.xlsx';
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
		$processLoan = $this->receiveCashFlowLoanData($webHookData['loanId']); //get cashflow crop data
		$processStatements = $this->receiveCashFlowStatementsData($webHookData['loanId']); //get cashflow crop data
		$processLoanHistory = $this->receiveCashFlowLoanHistoryData($webHookData['loanId']); //get cashflow crop data
		$processAssetsAndLiability = $this->receiveAssetsAndLiabilityData($webHookData['loanId']); //get cashflow crop data
		$processOtherInformation = $this->receiveCashFlowOtherInformationData($webHookData['loanId']); //get cashflow crop data
		$processCrops = $this->receiveCashFlowCropsData($webHookData['loanId']); //get cashflow crop data
		$processAnimals = $this->receiveCashFlowAnimalsData($webHookData['loanId']); //get cashflow crop data
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
											 $objPHPExcel->setActiveSheetIndex(0);
											 $objWriter->setPreCalculateFormulas(true); //making sure calculation takes place before saving
					  $createdFolder = $this->_create_storage() . '/';  //adding the slash to point to inside the dir
					  $savedPath = $createdFolder . $fileName; //joining the created folder and the file name for the path
						//  $objWriter->save(str_replace(__FILE__,'./docs/'. $createdFolder . $fileName . '.xlsx',__FILE__));
						$objWriter->save(str_replace(__FILE__,'./docs/'. $savedPath . '.xlsx',__FILE__));
						//Getting the file name to be saved in database
					$savedFilePath = base_url() . 'docs/'.$savedPath. '.xlsx'; //send this to db
								$this->CashFlow->save_file($savedFilePath);
								$cashflowFile['path'] = './docs/'. $savedPath . '.xlsx'; //returning the file
								$cashflowFile['loanId']= $webHookData['loanId'];
								return $cashflowFile ;
	}
	private function generateFinancialSummary($cashflowFile)
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
						 $cashflowResultData['realFilePath']= realpath($cashflowFile);

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
	private function generateRandomId()
			{
				$time = time();
				$currentTime = $time;
				$random1= rand(0,9999999999);
				$random2 = mt_rand();
				$random = $random1 * $random2;
				$a= ($currentTime + $random);
				$un=  uniqid();
				$conct = $a . $un  . md5($a);
				$cashflowRandomId = sha1($conct.$un);
						return $cashflowRandomId;
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
				if (!mkdir('./docs/' . $today, 0777, true)) {
							die('Failed to create folders...'); // Die if the function mkdir cannot run
					}
				return $today;
			} elseif (is_dir('docs/' . $today)){ //check if the folder is created and return it
				return $today;
			} else {
				return $today; 				// Return the folder if its already created in the file system
			}
	}

}
