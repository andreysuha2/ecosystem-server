<?php

namespace App\Http\Resources\Valet;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ValetsCollection extends ResourceCollection
{
    public static $wrap = 'valets';

    private $withData;
    private $includes;

    public function __construct($resource, $withData = false, $includes = false) {
        parent::__construct($resource);
        $this->withData = $withData;
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
        return $this->collection->map(function ($valet) {
            return new ValetResource($valet, $this->withData, $this->includes);
        })->toArray();
    }
}
