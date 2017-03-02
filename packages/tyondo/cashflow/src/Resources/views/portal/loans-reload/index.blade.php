@extends('layouts.admin')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Models <small>generated models in the system</small></h3>
      </div>
    </div>
    <div class="clearfix"></div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Cashflow Model</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Loan ID</th>
                  <th>Client ID</th>
                  <th>Office</th>
                  <th>Status</th>
                  <th>Reload</th>
                </tr>
              </thead>
              <tbody>
            @if(isset($cashflows))
              @foreach($cashflows as $cashflow)
                <tr>
                  <td>
                    <a href="{{env('CASHFLOW_LOAN_URL') . $cashflow->loanId}}" target="_blank">{{$cashflow->loanId}}</a>
                  </td>
                  <td>{{$cashflow->clientId}}</td>
                  <td>{{$cashflow->office->name}}</td>
                  <td>{{$cashflow->processed == 1 ? 'Processed': 'Pending'}}</td>
                  <td>
                    {!! Form::open(['action' => 'CashflowReloadController@store', 'method' => 'post']) !!}
                        {{ Form::text('id', $cashflow->id, ['required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12 hidden ']) }}
                        {{ Form::text('clientId', $cashflow->clientId, ['required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12 hidden ']) }}
                        {{ Form::text('officeId', $cashflow->officeId, ['required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12 hidden ']) }}
                        {{ Form::text('loanId', $cashflow->loanId, ['required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12 hidden ']) }}
                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-refresh "></i> Cashflow Reload</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
