<?php

namespace Tyondo\Cashflow\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'updated_at','created_at'];
}
