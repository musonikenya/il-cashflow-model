<?php

namespace Tyondo\Cashflow\Controllers;

use Illuminate\Http\Request;
use Tyondo\Cashflow\Notifications\CashflowCreated;
use Tyondo\Cashflow\Notifications\CashflowEdited;
use Tyondo\Cashflow\Models\Cashflow;
use Tyondo\Cashflow\Models\CashflowEdit;
use Tyondo\Cashflow\Models\User;

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$this->localTesting();

      $file = public_path('Data/cashLog.txt');
      file_put_contents($file, $request->all());
      error_reporting(0);
      ini_set('xdebug.max_nesting_level', 600);
      ini_set('max_execution_time', 300);
      $webhookPost = file_get_contents("php://input");
            if(isset($webhookPost))
                    {
                        $notification = json_decode($webhookPost);
                    //	http_response_code(200); //ok
                            if(isset($notification->loanId))
                                        {
                                            $webHookData = array(
                                            'officeId' => $notification->officeId,
                                            'clientId' => $notification->clientId,
                                            'loanId' => $notification->loanId,
                                            'resourceId' => $notification->resourceId,
                                            'processed' => 0,
                                        );
                                           // return 'Cashflow Before storage Method';
             //save notification to db
              $this->storeToDbNotification($notification);
                //Processing application
                                        $cashflowFile =	$this->newCashflowModel->computeCashFlowModel($webHookData);
                                        //To view all the errors generated by this function...move the method to this script.
                                        $cashflowSummaryData = 	$this->generatefinancialsummary->generateFinancialSummary($cashflowFile); //getting the summary
                                        //Sending the data to server
                                            //disable when testing
                						$summaryStatus =	$this->processCashflowUploads->uploadData($cashflowSummaryData); //sending summary and uploading file

                $this->updateToDbNotification($cashflowSummaryData, $this->notificationId, $this->updateNotificationId);

                  	    return $summaryStatus;
                        //                    return $cashflowSummaryData; //enable me when testing
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

        $isLoanThere = Cashflow::where(array('loanId'=>$notification->loanId))->get();
            foreach ($isLoanThere as $value) {
              $cashflowId = $value->loanId;
              $id = $value->id;
              $timesEdited = $value->timesEdited;
            }
              if (isset($cashflowId)) {
                //incrementing counter for edited loans
                $cashflowDb = Cashflow::find($id);
                  $cashflowDb->timesEdited = $timesEdited + 1;
                  $cashflowDb->save();
              }
            if(empty($cashflowId))
            {
              $cashflowDb = new Cashflow;
              $cashflowDb->officeId = $notification->officeId;
              $cashflowDb->office_Id = $notification->officeId;
              $cashflowDb->clientId = $notification->clientId;
              $cashflowDb->loanId = $notification->loanId;
              $cashflowDb->resourceId = $notification->resourceId;
              $cashflowDb->processed = 0;
              $cashflowDb->save();
              $this->notificationId = $cashflowDb->id;
              return true;
            }else{
              $cashflowDb = new CashflowEdit;
              $cashflowDb->officeId = $notification->officeId;
              $cashflowDb->office_Id = $notification->officeId;
              $cashflowDb->cashflowId = $cashflowId;
              $cashflowDb->clientId = $notification->clientId;
              $cashflowDb->loanId = $notification->loanId;
              $cashflowDb->resourceId = $notification->resourceId;
              $cashflowDb->processed = 0;
              $cashflowDb->save();
              $this->updateNotificationId = $cashflowDb->id;
              return true;
            }
    }

    private function updateToDbNotification($cashflowSummaryData, $notificationId, $updateNotificationId)
    {
      if(isset($notificationId))
      {
        $cashflowDb = Cashflow::find($notificationId);
          $cashflowDb->realFilePath = $cashflowSummaryData['realFilePath'];
          $cashflowDb->savedFilePath = $cashflowSummaryData['savedFilePath'];
          $cashflowDb->path = $cashflowSummaryData['path'];
          $cashflowDb->processed = 1;
          $cashflowDb->save();
            //sending notification
              $users = User::all();
              //$model = App\Cashflow::first();
              /*
              //The construct below is to test sending of bulk notification via the channels
                $users = App\User::all();
                $models = App\Cashflow::all();
                    foreach ($models as $model) {
                        foreach ($users as $user) {
                          $user->notify(new CashflowCreated($model));
                          //print_r($user);
                        }
                    }
              /////////////////////////
              */
              $model = Cashflow::find($cashflowDb->id);
                  foreach ($users as $user) {
                      $user->notify(new CashflowCreated($model));
                  }
          return $cashflowDb->id;

      }elseif (isset($updateNotificationId)) {
        $cashflowDb = CashflowEdit::find($updateNotificationId);
          $cashflowDb->realFilePath = $cashflowSummaryData['realFilePath'];
          $cashflowDb->savedFilePath = $cashflowSummaryData['savedFilePath'];
          $cashflowDb->path = $cashflowSummaryData['path'];
          $cashflowDb->processed = 1;
          $cashflowDb->save();
              $users = User::all(); //sending notification
              $model = CashflowEdit::find($cashflowDb->id);
                  foreach ($users as $user) {
                      $user->notify(new CashflowEdited($model));
                  }
          return $cashflowDb->id;
      }

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
      $notificationId =  $this->storeToDbNotification($webHookData); //edit
      $cashflowFile =	$this->newCashflowModel->computeCashFlowModel($webHookData);
      $cashflowSummaryData = 	$this->generatefinancialsummary->generateFinancialSummary($cashflowFile); //getting the summary
      //$summaryStatus =	$this->processCashflowUploads->uploadData($cashflowSummaryData); //sending summary and uploading file
      echo "<pre>";
      echo "string";
      print_r($cashflowSummaryData);
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
       // return 'Cashflow api call';
      $file = public_path('Data/cashLog.txt');
        file_put_contents($file, $request);
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