<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashflow;
use App\Office;
use App\CashflowEdit;

class ReportsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of th processed loans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashflows = Cashflow::all();

        return view('portal.loans.index', compact('cashflows'));
    }
    /**
     * This function displays a listing of all edited loans
     * @author Raphael Ndwiga
     * @return [[Type]] [[Description]]
     */
    public function editedLoans()
    {
        $cashflows = CashflowEdit::all();
        return view('portal.loans.editedLoans', compact('cashflows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * This function prompts downloading of the generated excel document
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      foreach ((Cashflow::where('id',$id)->get()) as $model) {
        $model = public_path($model->path);
      }
        $headers = array(
          'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        );
        return response()->download($model);
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
