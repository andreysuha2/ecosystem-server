<?php

use Illuminate\Database\Seeder;
use App\Models\Currency\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [ 'code' => "USD", 'symbol' => "&#36;", 'name' => "dollar" ],
            [ 'code' => "EUR", 'symbol' => "&#128;", 'name' => "euro" ],
            [ 'code' => "UAH", 'symbol' => "&#8372;", 'name' => "hryvnia" ],
            [ 'code' => "GBP", 'symbol' => "&#163;", 'name' => "pound sterling"],
            [ 'code' => "RUB", 'symbol' => "&#8381;", 'name' => "ruble" ],
            [ 'code' => "XBT", 'symbol' => "&#8383;", 'name' => "bitcoin" ]
        ]);
    }
}
