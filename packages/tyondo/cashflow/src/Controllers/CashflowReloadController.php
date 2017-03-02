<?php

namespace Tyondo\Cashflow\Controllers;

use Illuminate\Http\Request;
use App\Cashflow;

class CashflowReloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashflows = Cashflow::all();
        return view('portal.loans-reload.index', compact('cashflows'));
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
        error_reporting(0);
        ini_set('xdebug.max_nesting_level', 600);
        ini_set('max_execution_time', 300);
        $input = $request->all();
        $cashflows = Cashflow::all();
        $reload_data = array(
            'id' => $input['id'],
            'loanId' => $input['loanId'],
            'clientId' => $input['clientId'],
            'officeId' => $input['officeId'],
        );
        $cashflowFile =	$this->newCashflowModel->computeCashFlowModel($reload_data);
        $cashflowSummaryData = 	$this->generatefinancialsummary->generateFinancialSummary($cashflowFile); //getting the summary
        $summaryStatus =	$this->processCashflowUploads->uploadData($cashflowSummaryData); //sending summary and uploading file
        $this->updateDb($reload_data, $cashflowSummaryData);

        return view('portal.loans-reload.index', compact('cashflows'));

    }
    private function updateDb ($reload_data, $cashflowSummaryData)
    {
        $cashflowDb = Cashflow::find($reload_data['id']);
        $cashflowDb->realFilePath = $cashflowSummaryData['realFilePath'];
        $cashflowDb->savedFilePath = $cashflowSummaryData['savedFilePath'];
        $cashflowDb->path = $cashflowSummaryData['path'];
        $cashflowDb->save();
        return $cashflowDb->id;
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
        $input = $request->all();
        $model = Cashflow::where('id', $id)->get();
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
