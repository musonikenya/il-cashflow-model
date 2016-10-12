<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowloanhistorylibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $this->CI->load->library('cashflowdropdownslibrary');
      //  $CI->load->helper('myhelper');
      }
  public function receiveCashFlowLoanHistoryData($loanId = NULL)
    		{
    			/*
    				Processing loan history data
    			*/
    			$urlExtention = "/datatables/cct_Loanhistory/" . $loanId; //get the loan ID from the webhook post
    				$cashflowLoanHistory =	$this->CI->cashflowlibrary->curlOption($urlExtention);
    								$clientLoanHistory = array();
    			//Loan 1
    		//	"YesNo_cd_Add_a_loan": "243"
    					//Checking if the first loan option is selected
    				if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_loan'] == 243 ) {
    						$timelyRepayment1 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_1']); //dropdown yesno
    									$loan1History = array(
    									'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_1'],
    									'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_1'],
    								//	'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_1']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['2'],
    									'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_1']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['0'],
    									'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_1'],
    									'timelyPayments' => $timelyRepayment1['name'],
    									'loanComment' => $cashflowLoanHistory['0']['Comments_loan_1'],
    								);
    									//	return $loanHistory;
    													//Checking if the second loan option is selected
    										if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_second_loan'] == 243) {
    											//row 2
    													//"YesNo_cd_Add_a_second_loan": "243",
    												$timelyRepayment2 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_2']); //dropdown yesno
    												$loan2History = array(
    																	'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_2'],
    																	'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_2'],
    																	//'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_2']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['2'],
    																	'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_2']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['0'],
    																	'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_2'],
    																	'timelyPayments' => $timelyRepayment2['name'],
    																	'loanComment' => $cashflowLoanHistory['0']['Comments_loan_2'],
    																);

    																//Checking if the third loan option is selected
    																if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_third_loan'] == 243) {
    																				//row 3
    																				//	"YesNo_cd_Add_a_third_loan": "243",
    																	$timelyRepayment3 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_3']); //dropdown yesno
    																				$loan3History = array(
    																						'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_3'],
    																						'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_3'],
    																						//'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_3']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['2'],
    																						'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_3']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['0'],
    																						'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_3'],
    																						'timelyPayments' => $timelyRepayment3['name'],
    																						'loanComment' => $cashflowLoanHistory['0']['Comments_loan_3'],
    																					);

    																						//Checking if the fourth loan option is selected
    																							if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fourth_loan'] == 243) {
    																											//row 4
    																												//	"YesNo_cd_Add_a_fourth_loan": "243",
    																									$timelyRepayment4 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_4']); //dropdown yesno
    																									$loan4History = array(
    																													'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_4'],
    																													'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_4'],
    																													//'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_4']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['2'],
    																													'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_4']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['0'],
    																													'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_4'],
    																													'timelyPayments' => $timelyRepayment4['name'],
    																													'loanComment' => $cashflowLoanHistory['0']['Comments_loan_4'],
    																												);

    																												//Checking if the fifth loan option is selected
    																														if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fifth_loan'] == 243) {
    																																	//row 5
    																																	//	"YesNo_cd_Add_a_fifth_loan": "243",
    																																	$timelyRepayment5 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_5']); //dropdown yesno
    																																	$loan5History = array(
    																																					'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_5'],
    																																					'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_5'],
    																																					//'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_5']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['2'],
    																																					'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_5']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['0'],
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

}
