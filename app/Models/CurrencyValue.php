<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyValue extends Model
{
    protected $table = 'currency_value';

    protected $fillable = ['currency_id', 'value', 'created_at'];

    public $timestamps = false;
}
