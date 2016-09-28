<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowstatementslibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $this->CI->load->library('cashflowdropdownslibrary');
      //  $CI->load->helper('myhelper');
      }
      public function receiveCashFlowStatementsData($loanId = NULL)
      	{
      			/*
      				Processing statement data
      			*/
      			$urlExtention = "/datatables/cct_CashFlowStatements/" . $loanId; //get the loan ID from the webhook post
      				$CashFlowStatements =	$this->CI->cashflowlibrary->curlOption($urlExtention);
      				//row 1
      						$month1 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_1']); //dropdown month
      						$row1Statements = array(
      										'month'=> $month1['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_1'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_1'],
      									);
      				//row 2
      						$month2 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_2']); //dropdown month
      						$row2Statements = array(
      										'month'=> $month2['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_2'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_2'],
      									);
      				//row 3
      								$month3 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_3']); //dropdown month
      					$row3Statements = array(
      									'month'=> $month3['name'],
      									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_3'],
      									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_3'],
      								);
      				//row 4
      									$month4 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_4']); //dropdown month
      						$row4Statements = array(
      										'month'=> $month4['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_4'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_4'],
      									);
      				//row 5
      							$month5 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_5']); //dropdown month

      						$row5Statements = array(
      										'month'=> $month5['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_5'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_5'],
      									);
      				//row 6
      								$month6 =		$this->CI->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_6']); //dropdown month
      					$row6Statements = array(
      									'month'=> $month6['name'],
      									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_6'],
      									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_6'],
      								);
      								$statements = array($row1Statements,$row2Statements,$row3Statements,$row4Statements,$row5Statements,$row6Statements);
      									return $statements;
      	}

}
