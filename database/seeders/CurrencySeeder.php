<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Currency())->insert([
            ['id' => 1, 'char_code' => 'RUR'],
            ['id' => 2, 'char_code' => 'USD'],
            ['id' => 3, 'char_code' => 'EUR'],
            ['id' => 4, 'char_code' => 'JPY'],
            ['id' => 5, 'char_code' => 'CNY'],
        ]);
    }
}
