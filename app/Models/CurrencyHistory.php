<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{

    public $timestamps = false;
    protected $table = 'currency_history';

    protected $fillable = ['currency_id', 'value', 'created_at'];
}
