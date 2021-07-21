<?php

namespace App\Http\Resources\Currency;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrenciesCollection extends ResourceCollection
{
    public static $wrap = 'currencies';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($currency) {
            return new CurrencyResource($currency);
        })->toArray();
    }
}
