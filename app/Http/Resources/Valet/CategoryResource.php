<?php

namespace App\Http\Resources\Valet;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public static $wrap = 'category';

    private $includes = false;

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
        $includeAll = $includes && count($includes) === 0;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author ? new UserResource($this->author) : null,
            'records' => [
                'total' => $this->records()->count(),
                'items' => $this->when(
                    $includes && (in_array('records', $includes) || $includeAll),
                    new RecordsCollection($this->records()->get())
                )
            ],
            'valet' => $this->when(
                $includes && (in_array('valet', $includes) || $includeAll),
                new ValetResource($this->valet)
            ),
            'dates' => [
                'createdAt' => $this->created_at->toJSON(),
                'updatedAt' => $this->updated_at->toJSON()
            ]
        ];
    }
}
