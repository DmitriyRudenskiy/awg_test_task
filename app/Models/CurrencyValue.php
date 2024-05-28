<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyValue extends Model
{

    public $timestamps = false;
    protected $table = 'currency_value';

    protected $fillable = ['currency_id', 'value', 'created_at'];
}
