<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\CashflowCreated;
use App\Cashflow;
use App\User;
use App\Cashflow\Computecashflowmodel;
use App\Cashflow\Generatefinancialsummary;
use App\Cashflow\CashflowUploadData;

class CashflowController extends Controller
{
  protected $generatefinancialsummary;
  protected $newCashflowModel;
  protected $processCashflowUploads;

  public function __construct() {
      $this->generatefinancialsummary = new Generatefinancialsummary;
      $this->newCashflowModel = new Computecashflowmodel;
      $this->processCashflowUploads = new CashflowUploadData;
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      error_reporting(0);
      ini_set('xdebug.max_nesting_level', 600);
  		$webhookPost = file_get_contents("php://input");
					if(isset($webhookPost))
							{
								$notification = json_decode($webhookPost);
								http_response_code(200); //ok
									if(isset($notification->loanId))
												{
													$webHookData = array(
													'officeId' => $notification->officeId,
													'clientId' => $notification->clientId,
													'loanId' => $notification->loanId,
													'resourceId' => $notification->resourceId,
													'processed' => 0,
												);
            //save notification to db
                      $notificationId =  $this->storeToDbNotification($notification);
						//Processing application
												$cashflowFile =	$this->newCashflowModel->computeCashFlowModel($webHookData);
												//To view all the errors generated by this function...move the method to this script.
												$cashflowSummaryData = 	$this->generatefinancialsummary->generateFinancialSummary($cashflowFile); //getting the summary
												//Sending the data to server
												$summaryStatus =	$this->processCashflowUploads->uploadData($cashflowSummaryData); //sending summary and uploading file
            //save Completed transaction to db
                        $notificationId =  $this->updateToDbNotification($cashflowSummaryData, $notificationId);
            //emailing notification
                            //  $this->emailCashflowNotification($cashflowSummaryData);

                            return $summaryStatus;
                              /*
																	if(($summaryStatus['code'] == 200) && ($fileStatus['code'] == 200)){
																					//setting the loan as processed in the db
																				$update =	$this->CashFlow->updateWebHookRecord($accessArray); //saving the data to db
																		return http_response_code(200); //response
																	}
                              */
												}else{
													return http_response_code(204); //no content
												}
							}else {
									return http_response_code(204); //no content
							}
    }
    private function storeToDbNotification($notification)
    {
        $cashflowDb = new Cashflow;
        $cashflowDb->officeId = $notification->officeId;
        $cashflowDb->clientId = $notification->clientId;
        $cashflowDb->loanId = $notification->loanId;
        $cashflowDb->resourceId = $notification->resourceId;
        $cashflowDb->processed = 0;
        $cashflowDb->save();

        return $cashflowDb->id;
    }
    private function updateToDbNotification($cashflowSummaryData, $notificationId)
    {
      $cashflowDb = Cashflow::find($notificationId);
        $cashflowDb->realFilePath = $cashflowSummaryData['realFilePath'];
        $cashflowDb->savedFilePath = $cashflowSummaryData['savedFilePath'];
        $cashflowDb->path = $cashflowSummaryData['path'];
        $cashflowDb->processed = 1;
        $cashflowDb->save();
          //sending notification
            $users = App\User::all();
            //$model = App\Cashflow::first();
            $model = Cashflow::find($cashflowDb->id);
                foreach ($users as $user) {
                    $user->notify(new CashflowCreated($model));
                }
        return $cashflowDb->id;
    }
    private function emailCashflowNotification($cashflowSummaryData)
    {
      Mail::send(new newCashflowModel($order));
    }
    /*
        This function is for running test on the local development
    */
    private function localTesting()
    {
        $webHookData = array(
                  'loanId' => 153074,
                  'officeId' => 18,
                );
      $cashflowFile =	$this->newCashflowModel->computeCashFlowModel($webHookData);
      $cashflowSummaryData = 	$this->generatefinancialsummary->generateFinancialSummary($cashflowFile); //getting the summary
      $summaryStatus =	$this->processCashflowUploads->uploadData($cashflowSummaryData); //sending summary and uploading file
      echo "<pre>";
      echo "string";
      print_r($summaryStatus);
      echo "</pre>";
      exit;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return  $this->index($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
