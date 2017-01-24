<?php
namespace App\Cashflow;

class Cashflowanimalslibrary {
    protected $cashflowlibrary;
    protected $cashflowdropdownslibrary;
  public function __construct() {
        $this->cashflowlibrary = new Cashflowlibrary;
        $this->cashflowdropdownslibrary = new Cashflowdropdownslibrary;
      }
    /**
     Processing Crops data
     * @param $loanId
     * @return array
    */
  public function receiveCashFlowAnimalsData($loanId = NULL)
      {
        $urlExtention = "/datatables/cct_CashFlowAnimals/" . $loanId; //get the loan ID from the webhook post
        $cashflowAnimals =	$this->cashflowlibrary->curlOption($urlExtention);
        //checking if option to add an animal is selected
          //row 1
        if ($cashflowAnimals['0']['YesNo_cd_Please_select_the_ma'] == 243) {
                $animal = $this->cashflowdropdownslibrary->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type']); //dropdown animal
                if($cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal'])
                {
                    $breed = $this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Pure_or_improved_breeds_animal']); //dropdown yesno
                }else{
                    $breed['name'] = null;
                }
                if($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal']){
                    $purchase =	$this->cashflowdropdownslibrary->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Purchased_feeds_animal']); //dropdown yesnoalternative
                }else{
                    $purchase['name'] = null;
                }
                if($cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home']){
                    $percentage1 = $this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Eggs_milk_do_you_consume_at_home']); //dropdown month
                }else{
                    $percentage1['name'] = null;
                }
                if($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home']){
                    $percentage2 = $this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_meat_do_you_consume_at_home']); //dropdown month
                }else{
                    $percentage2['name'] = null;
                }
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
                 //row 2
                if ($cashflowAnimals['0']['YesNo_cd_Add_Animal_Type_2'] == 243) {
                        $animal = $this->cashflowdropdownslibrary->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_2__Animal_Type']); //dropdown animal
                    if($cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure']){
                        $breed = $this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_2__Pure']); //dropdown yesno
                    }else{
                        $breed['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal']){
                        $purchase =	$this->cashflowdropdownslibrary->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_2Purchased_feeds_animal']); //dropdown yesnoalternative
                    }else{
                        $purchase['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs']){
                        $percentage1 =	$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Eggs']); //dropdown month
                    }else{
                        $percentage1['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima']){
                        $percentage2 =	$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_2__Anima']); //dropdown month
                    }else{
                        $percentage2['name'] = null;
                    }
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
                    //row 3
                    //Checking if a third animal is selected
                if ($cashflowAnimals['0']['YesNo_cd_Add_Animal_Type_3'] == 243) {
                        $animal = $this->cashflowdropdownslibrary->receiveCashFlowAnimalDropdownData($cashflowAnimals['0']['Cashflow_Animals_cd_Animal_Type_3__Animal_Type']); //dropdown animal
                    if($cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure']){
                        $breed = $this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowAnimals['0']['YesNo_cd_Animal_Type_3__Pure']); //dropdown yesno
                    }else{
                        $breed['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal']){
                        $purchase =	$this->cashflowdropdownslibrary->receiveCashFlowYesNoAlternateDropdownData($cashflowAnimals['0']['Cashflow_YesNoAlternative_cd_Animal_Type_3Purchased_feeds_animal']); //dropdown yesnoalternative
                    }else{
                        $purchase['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm']){
                        $percentage1 = $this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Eggsm']);  //dropdown month
                    }else{
                        $percentage1['name'] = null;
                    }
                    if($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima']){
                        $percentage2 = $this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowAnimals['0']['Cashflow_Percentage_cd_Animal_Type_3__Anima']); //dropdown month
                    }else{
                        $percentage2['name'] = null;
                    }
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
                        /*if all the animals have been captured return all the 3 animals*/
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
}
