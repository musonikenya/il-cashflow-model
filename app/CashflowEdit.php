<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashflowEdit extends Model
{
  protected $fillable = [
      'cashflowId', 'loanId', 'officeId', 'clientId', 'resourceId', 'realFilePath', 'savedFilePath', 'path','processed'
  ];
}
