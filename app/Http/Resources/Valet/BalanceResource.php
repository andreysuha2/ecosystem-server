<?php

namespace App\Http\Resources\Valet;

use App\Http\Resources\Currency\CurrencyResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    public static $wrap = 'balance';

    private $withValet;

    public function __construct($resource, $withValet = false) {
        parent::__construct($resource);
        $this->withValet = $withValet;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'description' => $this->description,
            'currency' => new CurrencyResource($this->currency),
            'author' => $this->author ? new UserResource($this->author) : null,
            'valet' => $this->when($this->withValet, new ValetResource($this->valet)),
            'dates' => [
                'createdAt' => $this->created_at->toJSON(),
                'updatedAt' => $this->updated_at->toJSON(),
                'date' => $this->date->toJSON()
            ]
        ];
    }
}
