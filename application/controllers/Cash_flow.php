<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow extends CI_Controller {

	public function __construct()
        {
                // Call the CI_Controller constructor
                parent::__construct();
			//	$this->load->model('Cash_flow_model', 'CashFlow');
					//	$this->load->helper('url');
						        //load the excel library
			//	$this->load->library('excel');
		//		$this->load->library('');
					//Loading other controllers
				//		$this->load->controller('trial');
        }

public function index()
	{
	//	$this->trial->index();
		/*
			Processing Other dropdown data
		*/
			//		$cashflowYesNoDropdown =	YesNoDropdownData($headers); //get data for animals cashflow
			$response = './docs/dropdownJayson/Months.json';
			$str_data = file_get_contents($response);
			$cashflowMonthsDropdown = json_decode($str_data, true);
			echo "<pre>";
	//		print_r($cashflowMonthsDropdown);
			echo "</pre>";
//exit;


		/*
			Processing Other information data
		*/
				//	$CashFlowStatements =	$this->receiveCashFlowStatementsData($headers); //get data for animals cashflow
			$response = './docs/Statements.json';
			$str_data = file_get_contents($response);
			$CashFlowStatements = json_decode($str_data, true);
			//row 1
						$month1 = array(
						//	'month' => $CashFlowStatements['0']['Cashflow_Month_cd_Month_1'],
							'id' => $CashFlowStatements['0']['Cashflow_Month_cd_Month_1'],
							'inflow' => $CashFlowStatements['0']['Cash_inflows_month_1'],
							'óutflow' => $CashFlowStatements['0']['Cash_outflows_month_1']
						);
						function call_back_function($value,$key) {
									echo "The key $key has the value $value";echo "<br>";
								}
								echo "<pre>";
								print_r($cashflowMonthsDropdown);
								echo "</pre>";
							//	$array1 = array("a"=>"green", "b"=>"brown", "c"=>"blue" );
						//	$array2 = array($array1, "d"=>"yellow", "e"=>"black");
						$find = array($CashFlowStatements, $month1 );
								array_walk_recursive($find,"call_back_function");
								exit;
			print_r($month1);
			echo 'month 1 ' . $CashFlowStatements['0']['Cashflow_Month_cd_Month_1'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_1'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_1'];echo "<br>";
			//row 2
			echo 'month 2 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_2'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_2'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_2'];echo "<br>";
			//row 3
			echo 'month 3 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_3'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_3'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_3'];echo "<br>";
			//row 4
			echo 'month 4 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_4'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_4'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_4'];echo "<br>";
			//row 5
			echo 'month 5 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_5'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_5'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_5'];echo "<br>";
			//row 6
			echo 'month 6 ' .  $CashFlowStatements['0']['Cashflow_Month_cd_Month_6'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_inflows_month_6'];echo "<br>";
			echo $CashFlowStatements['0']['Cash_outflows_month_6'];echo "<br>";

			echo "<pre>";
			print_r($CashFlowStatements);
			echo "</pre>";
exit;
/*
	Processing Other dropdown data
*/
	//		$cashflowYesNoDropdown =	YesNoDropdownData($headers); //get data for animals cashflow
	$response = './docs/dropdownJayson/YesNo.json';
	$str_data = file_get_contents($response);
	$cashflowYesNoDropdown = json_decode($str_data, true);
	echo "<pre>";
	print_r($cashflowYesNoDropdown);
	echo "</pre>";
exit;
/*
	Processing Other information data
*/
		//	$cashflowAssetsAndLiabilities =	$this->receiveAssetsAndLiabilityData($headers); //get data for animals cashflow
	$response = './docs/AssetsAndLiabilities.json';
	$str_data = file_get_contents($response);
	$cashflowAssetsAndLiabilities = json_decode($str_data, true);

				echo $cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_land_yours'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Cashflow_LandLocation_cd_Land_location'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['YesNo_cd_Is_the_house_yours'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Value_of_house_and_furniture'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Value_other_assets_s'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Value_stock_and_inventory'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['With_this_loan_are_y'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Cash_available_from'];echo "<br>";
				echo $cashflowAssetsAndLiabilities['0']['Debts_with_friends_other_people'];echo "<br>";

	echo "<pre>";
	print_r($cashflowAssetsAndLiabilities);
	echo "</pre>";
exit;
		/*
			Processing Other information data
		*/
				//	$CashFlowOtherInformation =	$this->receiveCashFlowOtherInformationData($headers);
			$response = './docs/OtherInformation.json';
			$str_data = file_get_contents($response);
			$CashFlowOtherInformation = json_decode($str_data, true);

				echo $CashFlowOtherInformation['0']['Cashflow_Percentage_cd_Labor_carried_out_pe'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Non_farming_activities_description'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Monthly_income_other_activities'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Monthly_expenditures_other_activities'];echo "<br>";
				//optional
				//row 1
				echo $CashFlowOtherInformation['0']['Type_of_investment'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Investment_amount'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment'];echo "<br>";
				//row 2
				echo $CashFlowOtherInformation['0']['investment_2_Type_of_Investment'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Investment_2_amount'];echo "<br>";
				echo $CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment_2'];echo "<br>";

			echo "<pre>";
			print_r($CashFlowOtherInformation);
			echo "</pre>";
exit;
		/*
			Processing Crops data
		*/
				//	$cashflowAnimals =	$this->receiveCashFlowAnimalsData($headers); //get data for animals cashflow
			$response = './docs/Animals.json';
			$str_data = file_get_contents($response);
			$cashflowAnimals = json_decode($str_data, true);
			//row 1
			echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type'];echo "<br>";
			echo $cashflowAnimals['0']['Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Number_of_animals_in'];echo "<br>";
			echo $cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home'];echo "<br>";
			//row 2
			echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_2__Animal_Type'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_2__Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_2__Numbe'];echo "<br>";
			echo $cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima'];echo "<br>";
			//row 3
			echo $cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_3__Animal_Type'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_3__Total_number_of_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Animal_Type_3__Numbe'];echo "<br>";
			echo $cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm'];echo "<br>";
			echo $cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima'];echo "<br>";
			//row other - not a must filled
			echo $cashflowAnimals['0']['Number_animals_to_be_sold_other_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Price_animal_sold_other_animals'];echo "<br>";
			echo $cashflowAnimals['0']['Yearly_expenditure_f'];echo "<br>";

			echo "<pre>";
			print_r($cashflowAnimals);
			echo "</pre>";
exit;
		/*
			Processing Crops data
		*/
				//	$cashflowCrops =	$this->receiveCashFlowCropsData($headers); //get data for crops cashflow
			$response = './docs/Crops.json';
			$str_data = file_get_contents($response);
			$cashflowCrops = json_decode($str_data, true);
											//row 1
								echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Acres_under_production_last_year_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Acres_expansion_this_year_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['YesNo_cd_Use_improved_high_yi'];echo "<br>";
								echo $cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Use_fertilizers_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Number_50_Kg_bags_fe'];echo "<br>";
								echo $cashflowCrops['0']['YesNo_cd_Use_pesticides_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Irrigation_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Cashflow_Month_cd_Month_planting_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Cashflow_Percentage_cd_Home_consumption_crop_1'];echo "<br>";
								echo $cashflowCrops['0']['Months_storage_crop_1'];echo "<br>";

									//row 2
								echo $cashflowCrops['0']['Cashflow_Crops_cd_Crop_2'];echo "<br>";
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
				echo "<pre>";
				print_r($cashflowCrops);
				echo "</pre>";
exit;
		/*
					Processing data from loan call for cash flow
					data not available is the branch
		*/
			//	 $CashFlowLoan =	$this->receiveCashFlowLoanData($headers); //get data for animals cashflow
		$response = './docs/loan.json';
		$str_data = file_get_contents($response);
		$CashFlowLoan = json_decode($str_data, true);

		echo "<br>";
		echo "<br>";
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

	//	echo "<br>";
	//	echo "<pre>";
	//	print_r($obj);
	//	echo "</pre>";
		exit;
		$headers = array(
				"authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
				"cache-control: no-cache",
				"content-type: application/json",
				"x-mifos-platform-tenantid: kenya"
			);
			$cashflowCrops =	$this->receiveCashFlowCropsData($headers); //get data for crops cashflow
			$cashflowAnimals =	$this->receiveCashFlowAnimalsData($headers); //get data for animals cashflow
			$CashFlowOtherInformation =	$this->receiveCashFlowOtherInformationData($headers); //get data for animals cashflow
			$cashflowAssetsAndLiabilities =	$this->receiveAssetsAndLiabilityData($headers); //get data for animals cashflow
			$CashFlowStatements =	$this->receiveCashFlowStatementsData($headers); //get data for animals cashflow
			$CashFlowLoan =	$this->receiveCashFlowLoanData($headers); //get data for animals cashflow
			echo "<pre>";
			print_r($CashFlowLoan);
			echo "</pre>";
			exit;

	}
	public function trashFunction()
	{
		$resultHeaders =  $this->accessApi();
								$headers = array();
						foreach ($resultHeaders as $row)
										{
													$headers[] = '"authorization: ' . $row['Authorization'] .  '",' .
																			'"cache-control: no-cache",' .
																			'"content-type: application/json",' .
																			'"x-mifos-platform-tenantid: kenya ",';
										}
		$cashflowCrops =	$this->receiveCashFlowCropsData($headers); //get data for crops cashflow



	//	print_r($cashflowCrops);

	}
	public function accessApi(){
							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_PORT => "8443",
								CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/authentication?username=APIConsumer&password=FB7pvqW7PLYgrzqu",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_POSTFIELDS => "",
								CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
								CURLOPT_HTTPHEADER => array(
									"cache-control: no-cache",
									"content-type: multipart/form-data; boundary=---011000010111000001101001",
									"postman-token: bdffadce-8331-0a8b-290f-7e3d63a0420e",
									"x-mifos-platform-tenantid: kenya"
								),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);

							if ($err) {
								echo "cURL Error #:" . $err;
							} else {
							//	echo $response;
								$obj = json_decode($response, true);
								/*
									Saving key to the db
								*/
										$data = array(
											'Authorization' => 'Basic ' . $obj['base64EncodedAuthenticationKey'],
											'X-Mifos-Platform-TenantId' => 'kenya',
											'Content-Type' => 'application/json'
											);
											/*
													checking if the authorization key exists in db
											*/
													$checkAuthoriazation =	$this->CashFlow->accessKey();
																if ($checkAuthoriazation) {
																				foreach ($checkAuthoriazation as $row)
																								{
																										//	$key = $row->Authorization; //get the authorization key from the object
																											$key = $row['Authorization']; //get the authorization key from the object
																										//	$id = $row->id;
																								}
																										if(strcmp($key,$obj['base64EncodedAuthenticationKey']) == 0)
																											{ //if the key in db is same as the one retrieved run
																												$accessArray =	$this->CashFlow->accessKey();
																														//	echo "string";
																														//	exit;
																															return $accessArray;
																											} else {
																													$update = 'update';  //replace data stored if it does not exist
																												//	echo $update;
																																$accessArray =	$this->CashFlow->accessKey($data, $update);
																															//	print_r($accessArray);
																														//	echo "string";
																														//	print_r($accessArray);
																														//	exit;
																												//		echo "funky";
																													//	exit;
																																return $accessArray;
																											}
																} else {
																	$accessArray =	$this->CashFlow->accessKey($data);
																				//	print_r($accessArray);
																					return $accessArray;
																}
							}
	}
	public function receiveCashFlowLoanData($headers)
	{

							$curl = curl_init();

							curl_setopt_array($curl, array(
							  CURLOPT_PORT => "8443",
							  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/loans/25280",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
								CURLOPT_HTTPHEADER => $headers,
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							if ($err) {
							  echo "cURL Error #:" . $err;
							} else {
								$obj = json_decode($response, true);
								return $obj;
							}
	}
	public function receiveCashFlowStatementsData($headers)
	{
							$curl = curl_init();

							curl_setopt_array($curl, array(
							  CURLOPT_PORT => "8443",
							  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/datatables/cct_CashFlowStatements/25280",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
								CURLOPT_HTTPHEADER => $headers,
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							if ($err) {
							  echo "cURL Error #:" . $err;
							} else {
								$obj = json_decode($response, true);
								return $obj;
							}
	}
	public function receiveCashFlowOtherInformationData($headers)
							{
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_PORT => "8443",
						  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/datatables/cct_CashFlowOtherInfo/25280",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "GET",
							CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
							CURLOPT_HTTPHEADER => $headers,
						));

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
						  echo "cURL Error #:" . $err;
						} else {
							$obj = json_decode($response, true);
							return $obj;
						}
	}
	public function receiveAssetsAndLiabilityData($headers)
	{
							$curl = curl_init();

							curl_setopt_array($curl, array(
							  CURLOPT_PORT => "8443",
							  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/datatables/cct_CashFlowAssetsandLiabilities/25280", //check this link
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
								CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
								CURLOPT_HTTPHEADER => $headers,
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);

							curl_close($curl);

							if ($err) {
							  echo "cURL Error #:" . $err;
							} else {
								$obj = json_decode($response, true);
								return $obj;
							}
	}
public function receiveCashFlowAnimalsData($headers)
{

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_PORT => "8443",
					  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/datatables/cct_CashFlowAnimals/25280", //25280 is the loan id
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
						CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
						CURLOPT_HTTPHEADER => $headers,
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
					  echo "cURL Error #:" . $err;
					} else {
					  //echo $response;
						$obj = json_decode($response, true);
						return $obj;
					}
}
public function receiveCashFlowCropsData($headers)
{
	/*
			retrieve crops data
	*/
//	print_r($headers);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_PORT => "8443",
	  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/datatables/cct_CashFlowCrops/25280", //the 25280 is the loan id. this has to come from db
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
	  CURLOPT_HTTPHEADER => $headers,
	/*  CURLOPT_HTTPHEADER => array(
	    "authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
	    "cache-control: no-cache",
	    "content-type: application/json",
	    "postman-token: 364b301e-805c-848d-5be2-28abd5f4e08b",
	    "x-mifos-platform-tenantid: kenya"
	  ),
		*/
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
			$obj = json_decode($response, true);
	  		return $obj;
	}

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
	public function YesNoDropdownData($headers)
	{
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_PORT => "8443",
					  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/codes/5/codevalues", //if to change only the int variable for looping call
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
						CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
						CURLOPT_HTTPHEADER => $headers,
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
					  echo "cURL Error #:" . $err;
					} else {
								$obj = json_decode($response, true);
						  		return $obj;
					}
	}
}
