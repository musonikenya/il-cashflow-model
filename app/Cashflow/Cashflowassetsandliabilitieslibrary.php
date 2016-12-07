<?php

namespace App\Cashflow;

use App\Cashflow\Cashflowlibrary;
use App\Cashflow\Cashflowdropdownslibrary;

class Cashflowassetsandliabilitieslibrary {
        protected $cashflowlibrary;
        protected $cashflowdropdownslibrary;
      public function __construct() {
          $this->cashflowlibrary = new Cashflowlibrary;
          $this->cashflowdropdownslibrary = new Cashflowdropdownslibrary;
        }
      public function receiveAssetsAndLiabilityData($loanId = NULL)
    	{
    			/*
    				Processing assets and liabilities data
    			*/
    			$urlExtention = "/datatables/cct_CashFlowAssetsandLiabilities/" . $loanId; //get the loan ID from the webhook post
    				$cashflowAssetsAndLiabilities =	$this->cashflowlibrary->curlOption($urlExtention);
    									$landYours =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_land_yours']); //dropdown yesno
    							$landlocation =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['Cashflow_LandLocation_cd_Land_location']); //dropdown landlocation
    							$houseYours =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_house_yours']); //dropdown yesno
                  $landRateMonth =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($cashflowAssetsAndLiabilities['0']['Cashflow_Month_cd_Month_when_land_rent_is_paid']); //month

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
    								'landRentPaidMonth'=> $landRateMonth['name'], //month dropdown
    							);
    					return (object)$AssetsAndLiabilities; //return an object for processing
    	}
}
