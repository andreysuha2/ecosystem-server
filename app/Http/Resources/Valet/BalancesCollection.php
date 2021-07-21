<?php

namespace App\Http\Resources\Valet;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BalancesCollection extends ResourceCollection
{
    public static $wrap = 'balances';

    private $withValet;

    public function __construct($resource, $withValet = false) {
        parent::__construct($resource);
        $this->withValet = $withValet;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($balance) {
            return new BalanceResource($balance, $this->withValet);
        })->toArray();
    }
}
