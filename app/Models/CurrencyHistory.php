<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    protected $table = 'currency_history';

    protected $fillable = ['currency_id', 'value', 'created_at'];

    public $timestamps = false;
}
