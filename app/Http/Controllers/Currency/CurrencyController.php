<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currency\CurrenciesCollection;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getList() {
        return new CurrenciesCollection(Currency::all());
    }

    public function getCurrency(Currency $currency) {
        return new CurrencyResource($currency);
    }
}
