<?php

namespace Tyondo\Cashflow\Models;

use Illuminate\Database\Eloquent\Model;

class CashflowEdit extends Model
{
  protected $fillable = [
      'cashflowId', 'loanId', 'officeId', 'clientId', 'resourceId', 'realFilePath', 'savedFilePath', 'path','processed'
  ];
  public function office()
    {
      return $this->belongsTo('App\Office', 'office_Id');

    }
}
