<?php

namespace Tyondo\Cashflow\Cashflow;

class Cashflowloanlibrary {
    protected $cashflowlibrary;

      public function __construct() {
        $this->cashflowlibrary = new Cashflowlibrary;
      }
        /**
          Processing data from loan call for cash flow
          data not available is the branch
          The details echoéd are the ones to be entered in the excel model
        */
      public function receiveCashFlowLoanData($loanId = NULL)
    	{
            $urlExtention = "/loans/" . $loanId; //get the loan ID from the webhook post
            $CashFlowLoan =	$this->cashflowlibrary->curlOption($urlExtention);
            isset($CashFlowLoan['graceOnPrincipalPayment']) ? $gracePrincipal = $CashFlowLoan['graceOnPrincipalPayment'] : $gracePrincipal = null;
            isset($CashFlowLoan['graceOnInterestPayment']) ? $graceInterest = $CashFlowLoan['graceOnInterestPayment'] : $graceInterest = null;
                 $loan = array(
                     'submissionDate' => $CashFlowLoan['timeline']['submittedOnDate']['0'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['1'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['2'],
                     'disbursementDate' => $CashFlowLoan['timeline']['expectedDisbursementDate']['0'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['1'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['2'],
                     'repaymentDate' => $CashFlowLoan['expectedFirstRepaymentOnDate']['0'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['1'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['2'],
                     'principalApplied' => $CashFlowLoan['principal'],
                     'interestRate' => $CashFlowLoan['interestRatePerPeriod'],
                     'repaymentFrequency' => $CashFlowLoan['termPeriodFrequencyType']['value'],
                     'repaymentEvery'	=> $CashFlowLoan['repaymentEvery'],
                     'installmentsNumber' => $CashFlowLoan['termFrequency'],
                     'gracePrincipal' => $gracePrincipal,
                     'graceInterest' => $graceInterest
                 );
             return (object)$loan;
    	}
}
