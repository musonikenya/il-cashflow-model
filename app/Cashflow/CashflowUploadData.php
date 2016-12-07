<?php
namespace App\Cashflow;

use App\Cashflow\Cashflowlibrary;

class CashflowUploadData {
    protected $cashflowlibrary;

  public function __construct() {
        $this->cashflowlibrary = new Cashflowlibrary;
      }
  public function uploadData($cashflowSummaryData)
  {
        $data['summary'] = $this->postFinancialSummary($cashflowSummaryData);
        $data['file'] = $this->uploadCashflowModel($cashflowSummaryData);
      return $data;
  }

  public function postFinancialSummary($cashflowSummaryData)
            {
                          $data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/" . $cashflowSummaryData['loanId'] ;
                          $data['postData'] = json_encode($cashflowSummaryData['summary']);
                          $data['httpRequestMethod'] = "POST"; //default is post
                          $feedback =	$this->cashflowlibrary->curlPostData($data); //uploading data

                              $msg = json_decode($feedback); //decoding the feedback
                            if(($msg->httpStatusCode) == 403){
                              //if the post failed try PUT
                                  $data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/" . $cashflowSummaryData['loanId'] ;
                                  $data['postData'] = json_encode($cashflowSummaryData['summary']);
                                  $data['httpRequestMethod'] = "PUT"; //default is post
                              $feedback =	$this->cashflowlibrary->curlPostData($data); //uploading data
                            }
                            //If the posting/updating is a success
                              $msg = json_decode($feedback); //decoding the feedback
                            if(isset($msg->resourceId)){
                                $feedback = array('status' => "success", 'code' => http_response_code(200));
                              //	return json_encode($feedback);
                                return $feedback;
                            }
            }
    public function uploadCashflowModel($cashflowSummaryData)
              {
                            $data['urlExtention'] = "/cct_CashFlowFinancialSummary/". $cashflowSummaryData['loanId'] ."/documents/?tenantIdentifier=kenya";
                                $filePath = $cashflowSummaryData['realFilePath'];
                                  //getting the file name
                                      $info = new \SplFileInfo($filePath);
                                        $filename = $info->getFilename();
                                $data['postData'] =	array(
                                                        "file" => new \CurlFile($filePath, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', $filename),
                                                        "name" => "image_CashflowModel",
                                                        "locale" => "en",
                                                        "appTableId" => $cashflowSummaryData['loanId'],
                                                      );
                                $feedback =	$this->cashflowlibrary->curlUploadFile($data); //sending the file
                                $msg = json_decode($feedback); //decoding the feedback
                                  if(isset($msg->resourceId)){ //if success
                                      $feedback = array('status' => "success", 'code' => http_response_code(200));
                                      return $feedback;
                                  }else {
                                    //return the error message
                                    return $msg;
                                  }
              }

}
