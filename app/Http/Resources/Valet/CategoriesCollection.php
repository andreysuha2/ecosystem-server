<?php

namespace App\Http\Resources\Valet;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesCollection extends ResourceCollection
{
    public static $wrap = 'categories';

    private $includes = false;

    public function __construct($resource, $includes = false) {
        parent::__construct($resource);
        $this->includes = $includes;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($category) {
            return new CategoryResource($category);
        })->toArray();
    }
}
