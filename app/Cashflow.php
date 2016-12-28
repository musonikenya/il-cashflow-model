<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    protected $fillable = [
      'loanId', 'officeId', 'clientId', 'resourceId', 'realFilePath', 'savedFilePath', 'path','processed','timesEdited'
    ];

    public function office()
      {
        return $this->belongsTo('App\Office', 'office_Id');
        //return $this->hasMany('App\Office');
        //return $this->hasOne('App\Office');
      }
}
