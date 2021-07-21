<?php

namespace App\Http\Controllers\Valet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Valet\CreateValetRequest;
use App\Http\Requests\Valet\ViewValetRequest;
use App\Http\Resources\Valet\ValetResource;
use App\Models\Currency\Currency;
use App\Models\Valet\Valet;
use App\Models\Valet\ValetBalance;
use Illuminate\Http\Request;

class ValetController extends Controller
{
    public function getValet(ViewValetRequest $request, Valet $valet) {
        return new ValetResource($valet, true, [ 'balances' ]);
    }

    public function createValet(CreateValetRequest $request) {
        $user = $request->user();
        $currency = Currency::find($request->default_currency);
        $valet = new Valet($request->toArray());
        $valet->defaultCurrency()->associate($currency);
        $user->valet()->save($valet);
        $valet->participants()->attach($user->id);
        $balances = collect($request->balances)->map(function ($balanceData) use ($user) {
            $currency = Currency::find($balanceData['currency']);
            $balance = new ValetBalance($balanceData);
            $balance->author()->associate($user);
            $balance->currency()->associate($currency);
            return $balance;
        });
        $valet->balances()->saveMany($balances);
        return new ValetResource($valet, true, [ 'balances' ]);
    }
}
