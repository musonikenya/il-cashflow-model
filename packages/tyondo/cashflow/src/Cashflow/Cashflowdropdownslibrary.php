<?php

namespace Tyondo\Cashflow\Cashflow;

class Cashflowdropdownslibrary {

        protected $cashflowlibrary; 

  public function __construct() {
        $this->cashflowlibrary = new Cashflowlibrary;
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
     public function receiveCashFlowHarvestMonthDropdownData($option = NULL)
       {
         $urlExtention = "/codes/161/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
     public function receiveCashFlowPlantingMonthDropdownData($option = NULL)
       {
         $urlExtention = "/codes/155/codevalues/" . $option; //get the loan ID from the webhook post
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

}
