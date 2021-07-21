<?php

namespace App\Http\Resources\Valet;

use App\Http\Resources\Currency\CurrencyResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ValetResource extends JsonResource
{
    private $withData;
    private $includes;

    public function __construct($resource, $withData = false, $includes = false) {
        parent::__construct($resource);
        $this->withData = $withData || $includes;
        $this->includes = $includes;
    }

    public static $wrap = 'valet';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $includes = $this->includes;
        $includesAll = $includes && count($includes) === 0;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "author" => $this->author ? new UserResource($this->author) : null,
            "defaultCurrency" => new CurrencyResource($this->default_currency),
            'data' => $this->when($this->withData, [
                'balances' => [
                    'total' => $this->balances()->count(),
                    'items' => $this->when(
                        $includes && (isset($includes['balances'])) || $includesAll,
                        new BalancesCollection($this->balances()->get())
                    )
                ],
                'records' => [
                    'total' => $this->records()->count(),
                    'items' => $this->when(
                        $includes && (isset($includes['records'])) || $includesAll,
                        new RecordsCollection($this->records()->get())
                    )
                ],
                'categories' => [
                    'total' => $this->categories()->count(),
                    'items' => $this->when(
                        $includes && (isset($includes['categories'])) || $includesAll,
                        new CategoriesCollection($this->categories()->get())
                    )
                ],
                'participants' => [
                    'total' => $this->participants()->count(),
                    'items' => $this->when(
                        $includes && (isset($includes['participants'])) || $includesAll,
                        new UsersCollection($this->participants()->get())
                    )
                ]
            ]),
            "dates" => [
                "createdAt" => $this->created_at->toJSON(),
                "updatedAt" => $this->updated_at->toJSON()
            ]
        ];
    }
}
