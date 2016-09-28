<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowdropdownslibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $this->CI->load->library('cashflowdropdownslibrary');
      //  $CI->load->helper('myhelper');
      }
      public function receiveCashFlowYesNoAlternateDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/146/codevalues/" . $option; //get the loan ID from the webhook post
      			return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowPercentageDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/147/codevalues/" . $option; //get the loan ID from the webhook post
      			return $this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowSourceSeedsDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/154/codevalues/" . $option; //get the loan ID from the webhook post
      			return $this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowMonthDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/149/codevalues/" . $option; //get the loan ID from the webhook post
      			return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowLandLocationDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/152/codevalues/" . $option; //get the loan ID from the webhook post
      			return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowYesNoDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/5/codevalues/" . $option ; //get the loan ID from the webhook post
      			return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowFertilizersYesNoDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/150/codevalues/" . $option; //get the loan ID from the webhook post
      			return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowIrrigationYesNoDropdownData($option = NULL)
      	{
      		$urlExtention = "/codes/151/codevalues/" . $option; //get the loan ID from the webhook post
      		return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      	}
      public function receiveCashFlowAnimalDropdownData($option = NULL)
      		{
      			$urlExtention = "/codes/145/codevalues/" . $option; //get the loan ID from the webhook post
      				return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      		}
      public function receiveCashFlowCropDropdownData($option = NULL)
      		{
      			$urlExtention = "/codes/144/codevalues/" . $option; //get the loan ID from the webhook post
      				return	$this->CI->cashflowlibrary->curlOption($urlExtention);
      		}

}
