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
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              These models contain both new and edited loans.
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Loan ID</th>
                  <th>Client ID</th>
                  <th>Office</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Path</th>
                </tr>
              </thead>
              <tbody>
            @if(isset($cashflows))
              @foreach($cashflows as $cashflow)
                <tr>
                  <td>
                    <a href="https://demo.musonisystem.com/kenya/index.php/Loan/Loan/{{$cashflow->loanId}}" target="_blank">{{$cashflow->loanId}}</a>
                  </td>
                  <td>{{$cashflow->clientId}}</td>
                  <td>{{$cashflow->officeId}}</td>
                  <td>{{$cashflow->processed == 1 ? 'Processed': 'Pending'}}
                  </td>
                  <td>{{$cashflow->created_at}}</td>
                  <td>
                    <a href="{{action('ReportsController@show', ['id' => $cashflow->id])}}">{{$cashflow->path}}</a>
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