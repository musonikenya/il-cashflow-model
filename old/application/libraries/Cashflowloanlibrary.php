<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowloanlibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $this->CI->load->library('cashflowdropdownslibrary');
      //  $CI->load->helper('myhelper');
      }
      public function receiveCashFlowLoanData($loanId = NULL)
    	{
    		/*
    					Processing data from loan call for cash flow
    					data not available is the branch
    					The details echoéd are the ones to be entered in the excel model
    		*/
    				$urlExtention = "/loans/" . $loanId; //get the loan ID from the webhook post
    				$CashFlowLoan =	$this->CI->cashflowlibrary->curlOption($urlExtention);
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
}
