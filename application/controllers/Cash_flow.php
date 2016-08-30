<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
        }
public function index()
	{
			//	$CashFlowLoan =	$this->receiveCashFlowLoanData(); //calling the function processing loan data
				$cashflowLoanHistory =	$this->receiveCashFlowLoanHistoryData(); //calling the function processing loan data
			//	$CashFlowStatements =	$this->receiveCashFlowStatementsData(); //get data for animals cashflow
		//	$CashFlowOtherInformation =	$this->receiveCashFlowOtherInformationData(); //get data for animals cashflow
			//	$cashflowAssetsAndLiabilities =	$this->receiveAssetsAndLiabilityData(); //get data for animals cashflow
					//	$cashflowAnimals =	$this->receiveCashFlowAnimalsData(); //get data for animals cashflow
						//		$cashflowCrops =	$this->receiveCashFlowCropsData(); //get data for crops cashflow
										//dropdowns
							//	$cashflowYesNo =	$this->receiveCashFlowYesNoDropdownData(); //get data for crops cashflow
							//	$cashflowAnimal =	$this->receiveCashFlowAnimalDropdownData(); //get data for crops cashflow
							//	$cashflowCrops =	$this->receiveCashFlowCropDropdownData(); //get data for crops cashflow
							//	$cashflowFertilizersYesNo =	$this->receiveCashFlowFertilizersYesNoDropdownData(); //get data for crops cashflow
							//	$cashflowIrrigationYesNo =	$this->receiveCashFlowIrrigationYesNoDropdownData(); //get data for crops cashflow
							//	$cashflowLandLocation =	$this->receiveCashFlowLandLocationDropdownData(); //get data for crops cashflow
							//	$cashflowMonth =	$this->receiveCashFlowMonthDropdownData(); //get data for crops cashflow
							//	$cashflowPercentage =	$this->receiveCashFlowPercentageDropdownData(); //get data for crops cashflow
							//	$cashflowYesNoAlternate =	$this->receiveCashFlowYesNoAlternateDropdownData(); //get data for crops cashflow
	}
public function receiveCashFlowYesNoAlternateDropdownData($option = NULL)
	{
		$urlExtention = "/codes/146/codevalues/" . $option; //get the loan ID from the webhook post
		//	$cashflowYesNoAlternate =	$this->cashflowlibrary->curlOption($urlExtention);
			return	$this->cashflowlibrary->curlOption($urlExtention);
		//	echo "<pre>";
		//		print_r($cashflowYesNoAlternate);
	//	echo "</pre>";
	}
public function receiveCashFlowPercentageDropdownData($option = NULL)
	{
		$urlExtention = "/codes/147/codevalues/" . $option; //get the loan ID from the webhook post
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
	public function receiveCashFlowLoanData()
	{
		/*
					Processing data from loan call for cash flow
					data not available is the branch
					The details echoéd are the ones to be entered in the excel model
		*/
				$urlExtention = "/loans/25280"; //get the loan ID from the webhook post
				$CashFlowLoan =	$this->cashflowlibrary->curlOption($urlExtention);

							 echo $CashFlowLoan['clientId'];echo "<br>";
							 echo $CashFlowLoan['accountNo'];echo "<br>";
							 echo $CashFlowLoan['principal'];echo "<br>";
							 echo $CashFlowLoan['termFrequency'];echo "<br>";
							 echo $CashFlowLoan['interestRatePerPeriod'];echo "<br>";
							 echo $CashFlowLoan['graceOnPrincipalPayment'];echo "<br>";
							 echo $CashFlowLoan['graceOnInterestPayment'];echo "<br>";
							 echo $CashFlowLoan['timeline']['expectedDisbursementDate']['0'] . $CashFlowLoan['timeline']['expectedDisbursementDate']['1'] . $CashFlowLoan['timeline']['expectedDisbursementDate']['2'] ;echo "<br>";
							 echo $CashFlowLoan['timeline']['submittedOnDate']['0'] . $CashFlowLoan['timeline']['submittedOnDate']['1'] . $CashFlowLoan['timeline']['submittedOnDate']['2'] ;echo "<br>";
							 echo $CashFlowLoan['expectedFirstRepaymentOnDate']['0'] . $CashFlowLoan['expectedFirstRepaymentOnDate']['1'] . $CashFlowLoan['expectedFirstRepaymentOnDate']['2'] ;echo "<br>";
							 echo $CashFlowLoan['termPeriodFrequencyType']['value'];
	}
public function receiveCashFlowStatementsData()
	{
			/*
				Processing statement data
			*/
			$urlExtention = "/datatables/cct_CashFlowStatements/25280"; //get the loan ID from the webhook post
				$CashFlowStatements =	$this->cashflowlibrary->curlOption($urlExtention);
				//row 1
			//	echo 'month 1 ' . $CashFlowStatements['0']['Cashflow_Month_cd_Month_1'];echo "<br>";
						$month1 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_1']); //dropdown month
					echo $month1['name'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_1'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_1'];echo "<br>";
				//row 2
						$month2 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_2']); //dropdown month
					echo $month2['name'];echo "<br>";
			//	echo 'month 2 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_2'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_2'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_2'];echo "<br>";
				//row 3
								$month3 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_3']); //dropdown month
							echo $month3['name'];echo "<br>";
			//	echo 'month 3 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_3'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_3'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_3'];echo "<br>";
				//row 4
									$month4 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_4']); //dropdown month
								echo $month4['name'];echo "<br>";
			//	echo 'month 4 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_4'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_4'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_4'];echo "<br>";
				//row 5
							$month5 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_5']); //dropdown month
						echo $month5['name'];echo "<br>";
			//	echo 'month 5 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_5'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_5'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_5'];echo "<br>";
				//row 6
								$month6 =		$this->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_6']); //dropdown month
							echo $month6['name'];echo "<br>";
			//	echo 'month 6 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_6'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_inflows_month_6'];echo "<br>";
				echo $CashFlowStatements['0']['Cash_outflows_month_6'];echo "<br>";
	}
	public function receiveCashFlowLoanHistoryData()
		{
			/*
				Processing loan history data
			*/
			$urlExtention = "/datatables/cct_Loanhistory/25280"; //get the loan ID from the webhook post
				$cashflowLoanHistory =	$this->cashflowlibrary->curlOption($urlExtention);
				echo "<pre>";
			//	print_r($cashflowLoanHistory);
				echo "</pre>";

				echo $cashflowLoanHistory['0']['YesNo_cd_Add_a_loan'];echo "<br>"; //use this to build a function to process the rest of the data
				echo $cashflowLoanHistory['0']['Loan_amount_loan_1'];echo "<br>";
				echo $cashflowLoanHistory['0']['Current_balance_loan_1'];echo "<br>";
				echo $cashflowLoanHistory['0']['Date_disbursed_loan_1']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['2'] ;echo "<br>";
				echo $cashflowLoanHistory['0']['Institution_loan_1'];echo "<br>";
				echo $cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_1'];echo "<br>";
							$time1 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_1']); //dropdown yesno
						echo $time1['name'];echo "<br>";
				echo $cashflowLoanHistory['0']['Comments_loan_1'];echo "<br>";
				//row 2
/*
	build a function that uses 'YesNo_cd_Add' to check whether data has been captured for the value, if it is process
	activiate this block after building it
*/
/*				echo $cashflowLoanHistory['0']['YesNo_cd_Add_a_second_loan'];echo "<br>"; //use this to build a function to process the rest of the data
				echo $cashflowLoanHistory['0']['Loan_amount_loan_2'];echo "<br>";
				echo $cashflowLoanHistory['0']['Current_balance_loan_2'];echo "<br>";
				echo $cashflowLoanHistory['0']['Date_disbursed_loan_2']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['2'] ;echo "<br>";
				echo $cashflowLoanHistory['0']['Institution_loan_2'];echo "<br>";
				echo $cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_2'];echo "<br>";
							$time2 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_2']); //dropdown yesno
						echo $time2['name'];echo "<br>";
				echo $cashflowLoanHistory['0']['Comments_loan_2'];echo "<br>";
				//row 3
				echo $cashflowLoanHistory['0']['YesNo_cd_Add_a_third_loan'];echo "<br>"; //use this to build a function to process the rest of the data
				echo $cashflowLoanHistory['0']['Loan_amount_loan_3'];echo "<br>";
				echo $cashflowLoanHistory['0']['Current_balance_loan_3'];echo "<br>";
				echo $cashflowLoanHistory['0']['Date_disbursed_loan_3']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['2'] ;echo "<br>";
				echo $cashflowLoanHistory['0']['Institution_loan_3'];echo "<br>";
				echo $cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_3'];echo "<br>";
						$time3 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_3']); //dropdown yesno
					echo $time3['name'];echo "<br>";
				echo $cashflowLoanHistory['0']['Comments_loan_3'];echo "<br>";
				//row 4
				echo $cashflowLoanHistory['0']['YesNo_cd_Add_a_fourth_loan'];echo "<br>"; //use this to build a function to process the rest of the data
				echo $cashflowLoanHistory['0']['Loan_amount_loan_4'];echo "<br>";
				echo $cashflowLoanHistory['0']['Current_balance_loan_4'];echo "<br>";
				echo $cashflowLoanHistory['0']['Date_disbursed_loan_4']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['2'] ;echo "<br>";
				echo $cashflowLoanHistory['0']['Institution_loan_4'];echo "<br>";
				echo $cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_4'];echo "<br>";
						$time4 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_4']); //dropdown yesno
					echo $time4['name'];echo "<br>";
				echo $cashflowLoanHistory['0']['Comments_loan_4'];echo "<br>";
				//row 5
				echo $cashflowLoanHistory['0']['YesNo_cd_Add_a_fifth_loan'];echo "<br>"; //use this to build a function to process the rest of the data
				echo $cashflowLoanHistory['0']['Loan_amount_loan_5'];echo "<br>";
				echo $cashflowLoanHistory['0']['Current_balance_loan_5'];echo "<br>";
				echo $cashflowLoanHistory['0']['Date_disbursed_loan_5']['0'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['2'] ;echo "<br>";
				echo $cashflowLoanHistory['0']['Institution_loan_5'];echo "<br>";
				echo $cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_5'];echo "<br>";
						$time5 =		$this->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_5']); //dropdown yesno
					echo $time5['name'];echo "<br>";
				echo $cashflowLoanHistory['0']['Comments_loan_5'];echo "<br>";
*/
		}

	public function receiveAssetsAndLiabilityData()
	{
			/*
				Processing assets and liabilities data
			*/
			$urlExtention = "/datatables/cct_CashFlowAssetsandLiabilities/25280"; //get the loan ID from the webhook post
				$cashflowAssetsAndLiabilities =	$this->cashflowlibrary->curlOption($urlExtention);

						//	echo $cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_land_yours'];echo "<br>"; //dropdown yesno
									$landYours =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_land_yours']); //dropdown yesno
								echo $landYours['name'];echo "<br>";
							//	exit;

						//	echo $cashflowAssetsAndLiabilities['0']['Cashflow_LandLocation_cd_Land_location'];echo "<br>"; //dropdown landlocation
							$landlocation =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['Cashflow_LandLocation_cd_Land_location']); //dropdown landlocation
						echo $landlocation['name'];echo "<br>";
						//	exit;
						//	echo $cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_house_yours'];echo "<br>"; // yesno
							$houseYours =		$this->receiveCashFlowYesNoDropdownData($cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_house_yours']); //dropdown yesno
						echo $houseYours['name'];echo "<br>";
							//	exit;
							echo $cashflowAssetsAndLiabilities['0']['Value_of_house_and_furniture'];echo "<br>";
							echo $cashflowAssetsAndLiabilities['0']['Value_other_assets_s'];echo "<br>";
							echo $cashflowAssetsAndLiabilities['0']['Value_stock_and_inventory'];echo "<br>";
							echo $cashflowAssetsAndLiabilities['0']['With_this_loan_are_y'];echo "<br>";
							echo $cashflowAssetsAndLiabilities['0']['Cash_available_from'];echo "<br>";
							echo $cashflowAssetsAndLiabilities['0']['Debts_with_friends_other_people'];echo "<br>";
	}
	public function receiveCashFlowOtherInformationData()
	{
			/*
				Processing Other information data
			*/
			$urlExtention = "/datatables/cct_CashFlowOtherInfo/25280"; //get the loan ID from the webhook post
				$CashFlowOtherInformation =	$this->cashflowlibrary->curlOption($urlExtention);

				//	echo $CashFlowOtherInformation['0']['Cashflow_Percentage_cd_Labor_carried_out_pe'];echo "<br>"; //dropdown percentage
								$percentage =		$this->receiveCashFlowPercentageDropdownData($CashFlowOtherInformation['0']['Cashflow_Percentage_cd_Labor_carried_out_pe']); //dropdown month
							echo $percentage['name'];echo "<br>";
					echo $CashFlowOtherInformation['0']['Non_farming_activities_description'];echo "<br>";
					echo $CashFlowOtherInformation['0']['Monthly_income_other_activities'];echo "<br>";
					echo $CashFlowOtherInformation['0']['Monthly_expenditures_other_activities'];echo "<br>";
					//optional
					//row 1
					echo $CashFlowOtherInformation['0']['Type_of_investment'];echo "<br>";
					echo $CashFlowOtherInformation['0']['Investment_amount'];echo "<br>";
				//	echo $CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment'];echo "<br>"; //dropdown month
							$month1 =		$this->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment']); //dropdown month
						echo $month1['name'];echo "<br>";
					//row 2
					echo $CashFlowOtherInformation['0']['investment_2_Type_of_Investment'];echo "<br>";
					echo $CashFlowOtherInformation['0']['Investment_2_amount'];echo "<br>";
				//	echo $CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment_2'];echo "<br>"; //dropdown month
						$month2 =		$this->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment_2']); //dropdown month
						if(isset($month2['name'])){ echo $month2['name'];};echo "<br>"; //check whether the value has been retrieved and not all of it
									//modify this to ensure that call is made only if the data is available

	}

public function receiveCashFlowAnimalsData()
{
		/*
			Processing Crops data
		*/
		$urlExtention = "/datatables/cct_CashFlowAnimals/25280"; //get the loan ID from the webhook post
			$cashflowAnimals =	$this->cashflowlibrary->curlOption($urlExtention);
			//row 1
		//	echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type'];echo "<br>"; //dropdown animal
						$animal =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type']); //dropdown animal
					echo $animal['name'];echo "<br>";
			echo $cashflowAnimals['0']['Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Number_of_animals_in'];echo "<br>";
			//echo $cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal'];echo "<br>"; //dropdown yesno
						$breed =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal']); //dropdown yesno
					echo $breed['name'];echo "<br>";
			//echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal'];echo "<br>"; //dropdown yesnoalternative
							$purchase =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal']); //dropdown yesnoalternative
						echo $purchase['name'];echo "<br>";

		//	echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home'];echo "<br>"; //dropdwon percentage
								$percentage1 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home']); //dropdown month
							echo $percentage1['name'];echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home'];echo "<br>"; //dropdown percentage
							$percentage2 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home']); //dropdown month
						echo $percentage2['name'];echo "<br>";
/*
		From this point create a condition that checks whether the values below have been entered. if not terminate the script
		make use of yesno value requesting entry of data
*/
			//row 2
		//	echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_2__Animal_Type'];echo "<br>";
							$animal2 =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_2__Animal_Type']); //dropdown animal
					//	echo $animal2['name'];echo "<br>";
						if(isset($animal2['name'])){ echo $animal2['name'];};;echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_2__Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_2__Numbe'];echo "<br>";
		//	echo $cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure'];echo "<br>";
						$breed2 =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure']); //dropdown yesno
				//	echo $breed2['name'];echo "<br>";
					if(isset($breed2['name'])){ echo $breed2['name'];};;echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal'];echo "<br>";
					$purchase2 =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal']); //dropdown yesnoalternative
			//	echo $purchase2['name'];echo "<br>";
				if(isset($purchase2['name'])){ echo $purchase2['name'];};;echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs'];echo "<br>";
						$percentage12 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs']); //dropdown month
				//	echo $percentage12['name'];echo "<br>";
					if(isset($percentage12['name'])){ echo $percentage12['name'];};;echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima'];echo "<br>";
				$percentage22 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima']); //dropdown month
		//	echo $percentage22['name'];echo "<br>";
				if(isset($percentage22['name'])){ echo $percentage22['name'];};;echo "<br>";

/*
		From this point create a condition that checks whether the values below have been entered. if not terminate the script
		make use of yesno value requesting entry of data
		Activate after building the condition
*/
			//row 3
/*
		//	echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_3__Animal_Type'];echo "<br>";
						$animal3 =		$this->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_3__Animal_Type']); //dropdown animal
				//	echo $animal3['name'];echo "<br>";
					if(isset($animal3['name'])){ echo $animal3['name'];};;echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_3__Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_3__Numbe'];echo "<br>";
		//	echo $cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure'];echo "<br>";
						$breed3 =		$this->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure']); //dropdown yesno
				//	echo $breed3['name'];echo "<br>";
					if(isset($breed3['name'])){ echo $breed3['name'];};;echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal'];echo "<br>";
						$purchase3 =		$this->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal']); //dropdown yesnoalternative
				//	echo $purchase3['name'];echo "<br>";
					if(isset($purchase3['name'])){ echo $purchase3['name'];};;echo "<br>";
		//	echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm'];echo "<br>";
						$percentage13 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm']); //dropdown month
				//	echo $percentage13['name'];echo "<br>";
					if(isset($percentage13['name'])){ echo $percentage13['name'];};;echo "<br>";
			//echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima'];echo "<br>";
					$percentage23 =		$this->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima']); //dropdown month
			//	echo $percentage23['name'];echo "<br>";
					if(isset($percentage23['name'])){ echo $percentage23['name'];};;echo "<br>";
/*/
//		build a condition that checks whether these values exist if the dont, do not make an array
/*/
			//row other - not a must filled
			echo $cashflowAnimals['0']['Number_animals_to_be_sold_other_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Price_animal_sold_other_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Yearly_expenditure_f'];echo "<br>";
 */
}
public function receiveCashFlowCropsData()
{
	/*
			retrieve crops data
	*/
	$urlExtention = "/datatables/cct_CashFlowCrops/25280"; //get the loan ID from the webhook post
		$cashflowCrops =	$this->cashflowlibrary->curlOption($urlExtention);
	//	$response = './docs/Crops.json';
//	$str_data = file_get_contents($response);
	//	$cashflowCrops = json_decode($str_data, true);
										//row 1
						//	echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_1'];echo "<br>"; //dropdown crops
									$crop =		$this->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_1']); //dropdown animal
								echo $crop['name'];echo "<br>";
							//	if(isset($crop['name'])){ echo $crop['name'];};;echo "<br>";
							echo $cashflowCrops['0']['Acres_under_production_last_year_crop_1'];echo "<br>";
							echo $cashflowCrops['0']['Acres_expansion_this_year_crop_1'];echo "<br>";
						//	echo $cashflowCrops['0']['YesNo_cd_Use_improved_high_yi'];echo "<br>"; //dropdown yesno
									$improved =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Use_improved_high_yi']); //dropdown yesno
								echo $improved['name'];echo "<br>";
							//	if(isset($improved['name'])){ echo $improved['name'];};;echo "<br>";
							//echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Use_fertilizers_crop_1'];echo "<br>"; //dropdown fertilizer
										$fertilizer =		$this->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Use_fertilizers_crop_1']); //dropdown fertilizer
									echo $fertilizer['name'];echo "<br>";
							echo $cashflowCrops['0']['Number_50_Kg_bags_fe'];echo "<br>";
						//	echo $cashflowCrops['0']['YesNo_cd_Use_pesticides_crop_1'];echo "<br>"; //dropdown yesno
										$improved =		$this->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Use_pesticides_crop_1']); //dropdown yesno
									echo $improved['name'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Irrigation_crop_1'];echo "<br>"; //dropdown irrigationyesno
										$irrigation =		$this->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Irrigation_crop_1']); //dropdown irrigationyesno
									echo $irrigation['name'];echo "<br>";
						//	echo $cashflowCrops['0']['Cashflow_Month_cd_Month_planting_crop_1'];echo "<br>"; //dropdown month
											$month =		$this->receiveCashFlowMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_planting_crop_1']); //dropdown month
										echo $month['name'];echo "<br>";
						//	echo $cashflowCrops['0']['Cashflow_Percentage_cd_Home_consumption_crop_1'];echo "<br>"; //dropdown percentage
									$percentage =		$this->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Home_consumption_crop_1']); //dropdown month
								echo $percentage['name'];echo "<br>";
							//	if(isset($percentage['name'])){ echo $percentage['name'];};;echo "<br>";
							echo $cashflowCrops['0']['Months_storage_crop_1'];echo "<br>";
/*
Build condition that checks whether data has been set for the rows below if not ignore
Activate the fields after building the condition
*/
								//row 2
	/*						echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_2'];echo "<br>";
							echo $cashflowCrops['0']['Crop_2Acres_under_pr'];echo "<br>";
							echo $cashflowCrops['0']['Crop_2Acres_expansion_this_year_crop_2'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_2Use_improved_h'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_2Use_fertilizers_crop_2'];echo "<br>";
							echo $cashflowCrops['0']['Crop_2Number_50_Kg_b'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_2Use_pesticides_crop_2'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_2Irrigation'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Month_cd_Crop_2Month_planting'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Percentage_cd_Crop_2Home_consumption'];echo "<br>";
							echo $cashflowCrops['0']['Crop_2Months_storage'];echo "<br>";

							//row 3
							echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Crop_3Acres_under_pr'];echo "<br>";
							echo $cashflowCrops['0']['Crop_3Acres_expansion_this_year_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_3Use_improved_h'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_3Use_fertilizers_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Crop_3Number_50_Kg_b'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_3Use_pesticides_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_3Irrigation_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Month_cd_Crop_3Month_planting_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Percentage_cd_Crop_3Home_consumption_crop_3'];echo "<br>";
							echo $cashflowCrops['0']['Crop_3Months_storage_crop_3'];echo "<br>";

							//row 4
							echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Crop_4Acres_under_pr'];echo "<br>";
							echo $cashflowCrops['0']['Crop_4Acres_expansion_this_year_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_4Use_improved_h'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_4Use_fertilizers_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Crop_4Number_50_Kg_b'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_4Use_pesticides_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_4Irrigation_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Month_cd_Crop_4Month_planting_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Percentage_cd_Crop_4Home_consumption_crop_4'];echo "<br>";
							echo $cashflowCrops['0']['Crop_4Months_storage_crop_4'];echo "<br>";

							//row 5
						//	echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_5'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Crop_5Acres_expansion_this_year_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_5Use_improved_h'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_5Use_fertilizers_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Crop_5Number_50_Kg_b'];echo "<br>";
							echo $cashflowCrops['0']['YesNo_cd_Crop_5Use_pesticides_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_5Irrigation_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Month_cd_Crop_5Month_planting_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Percentage_cd_Crop_5Home_consumption_crop_5'];echo "<br>";
							echo $cashflowCrops['0']['Crop_5Months_storage_crop_5'];echo "<br>";

							//row optional processing
							echo $cashflowCrops['0']['Other_crops_specify'];echo "<br>";
							echo $cashflowCrops['0']['Kg_harvest_other_crops'];echo "<br>";
							echo $cashflowCrops['0']['Cashflow_Month_cd_Month_harvest_other_crops'];echo "<br>";
							echo $cashflowCrops['0']['Price_Kg_other_crops'];echo "<br>";
   */
}
private function saveToDb($data)
{
		/*
				This function will be used to save data to database depending on their
		*/
}
private function reader_write()
	{
		/*
			Introduce the PHPExcel Writer
		*/
		   // date_default_timezone_set('Europe/London');
		   ini_set('date.timezone', 'UTC'); //setting the default timezone
			$time = date('H:i:s');  //set the time
		// $inputFileType = 'Excel5';
        $inputFile = './docs/flow-demo.xlsx';
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
		$inputFileJ = './docs/new.json';
			$str_data = file_get_contents($inputFileJ);
			$fileContent = json_decode($str_data, true);
						//while ($fileContent = json_decode($str_data, true)) { //rewrite this loop
						//Setting Variables for the file
                           $baseRow = 6;
						    // Including the timestamp during the
						   $fileName= 'Flow-demo-Output - ' . date('m-d-Y_his') ; //$resfor=$dataname['name']; generate a random string for the file.
						//foreach loop to write data to file
						   foreach($fileContent as $r => $dataRow) {
									if (!is_array($dataRow)) {
										//echo $key . '=>' . $value . '<br/>';
										echo 'could not write to file';
										exit;
									} else {
								   $row = $baseRow + $r;
								  // $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
								   $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $dataRow['crop'])
														 ->setCellValue('B'.$row, $dataRow['acer'])
														 ->setCellValue('C'.$row, $dataRow['cropping'])
														 ->setCellValue('D'.$row, $dataRow['hybrid'])
														 ->setCellValue('E'.$row, $dataRow['fertilizer'])
														 ->setCellValue('F'.$row, $dataRow['pesticides'])
														 ->setCellValue('G'.$row, $dataRow['month'])
														 ->setCellValue('H'.$row, $dataRow['consume'])
														 ->setCellValue('I'.$row, $dataRow['storing']);
								   }  // end of foreachloop
						   }
                       //Saving the file
                       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					   //echo 'I got here';
					   //$objWriter->save('./docs/fin.xls');
					   //exit;
					   /*
						Calling the function to create folder based on date. if it does not run successfully, the script terminates.
					   */
					  $createdFolder = $this->_create_storage() . '/';  //adding the slash to point to inside the dir
					  $savedPath = $createdFolder . $fileName; //joining the created folder and the file name for the path

                  //  $objWriter->save(str_replace(__FILE__,'./docs/'. $createdFolder . $fileName . '.xlsx',__FILE__));
				  $objWriter->save(str_replace(__FILE__,'./docs/'. $savedPath . '.xlsx',__FILE__));
						//Getting the file name to be saved in database
					$savedFilePath = base_url() . 'docs/'.$savedPath. '.xlsx';
								$this->CashFlow->save_file($savedFilePath);
				   echo $savedFilePath; //remove this line later on
				   echo '<br>';
                       //$objWriter->save(str_replace('.php', '.xls', __FILE__));
                       //Set message to be written on the browser to confirm that the file has been written
                       echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
                        echo 'Done';
                       echo date('H:i:s') , " Done writing file";
                //}
	}
	private function _stripslashes_deep($value = NULL){
		//strip off slashes in the webhook notification
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);
    return $value;
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
				// mkdir('./docs/' . $today, 0777, true);
				if (!mkdir('./docs/' . $today, 0777, true)) {
							die('Failed to create folders...'); // Die if the function mkdir cannot run
					}
				return $today;
			} elseif (is_dir('docs/' . $today)){ //check if the folder is created and return it
				return $today;
			} else {
				return $today; 				// Return the folder if its already created in the file system
				//echo 'folder already exists';
			}
	}

}
