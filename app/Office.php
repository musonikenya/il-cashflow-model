<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
  protected $fillable = [
      'name',
  ];
  public function cashflow()
    {
      return $this->belongsTo('App\Cashflow');
      return $this->hasMany('App\Office');
      return $this->hasOne('App\Office');
    }

}
