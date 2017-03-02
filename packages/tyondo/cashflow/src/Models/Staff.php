<?php

namespace Tyondo\Cashflow\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  protected $fillable = [
      'name', 'email', 'officeId',
  ];
  public function role()
    {
      return $this->belongsTo('App\Role');
    }
  public function office()
    {
      return $this->belongsTo('App\Office');
    }
}
