<?php

namespace App\Http\Resources\Valet;

use App\Http\Resources\Currency\CurrencyResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            "defaultCurrency" => new CurrencyResource($this->defaultCurrency),
            'data' => $this->when($this->withData, [
                'balances' => [
                    'total' => $this->balances()->count(),
                    'items' => $this->when(
                        $includes && (in_array('balances', $includes) || $includesAll),
                        new BalancesCollection($this->balances()->get())
                    )
                ],
                'records' => [
                    'total' => $this->records()->count(),
                    'items' => $this->when(
                        $includes && (in_array('records', $includes)|| $includesAll),
                        new RecordsCollection($this->records()->get())
                    )
                ],
                'categories' => [
                    'total' => $this->categories()->count(),
                    'items' => $this->when(
                        $includes && (in_array('categories', $includes) || $includesAll),
                        new CategoriesCollection($this->categories()->get())
                    )
                ],
                'participants' => [
                    'total' => $this->participants()->count(),
                    'items' => $this->when(
                        $includes && (in_array('participants', $includes) || $includesAll),
                        new UsersCollection($this->participants()->get())
                    )
                ]
            ]),
            "permissions" => [
                "view" => Auth::user()->can('view', $this->resource),
                "update" => Auth::user()->can('update', $this->resource),
                "delete" => Auth::user()->can('delete', $this->resource)
            ],
            "dates" => [
                "createdAt" => $this->created_at->toJSON(),
                "updatedAt" => $this->updated_at->toJSON()
            ]
        ];
    }
}
