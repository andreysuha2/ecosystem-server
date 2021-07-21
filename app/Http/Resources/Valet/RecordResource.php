<?php

namespace App\Http\Resources\Valet;

use App\Http\Resources\Currency\CurrencyResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    public static $wrap = 'record';

    private $includes;

    public function __construct($resource, $includes = false) {
        parent::__construct($resource);
        $this->includes = $includes;
    }

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
            'id' => $this->id,
            'value' => $this->value,
            'type' => $this->type,
            'currency' => new CurrencyResource($this->currency),
            'description' => $this->description,
            'author' => $this->author ? new UserResource($this->author) : null,
            'category' => $this->when(
                $includes && (isset($includes['category']) || $includesAll),
                        new CategoryResource($this->category)
            ),
            'valet' => $this->when(
                $includes && (isset($includes['valet']) || $includesAll),
                new ValetResource($this->valet)
            ),
            'dates' => [
                'createdAt' => $this->created_at->toJSON(),
                'updatedAt' => $this->updated_at->toJSON()
            ]
        ];
    }
}
