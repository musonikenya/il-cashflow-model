<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    protected $fillable = [
      'loanId', 'officeId', 'clientId', 'resourceId', 'realFilePath', 'savedFilePath', 'path','processed','timesEdited'
    ];
}
