<?php

namespace App\Http\Resources\Valet;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecordsCollection extends ResourceCollection
{
    public static $wrap = 'records';

    private $includes;

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
        return $this->collection->map(function ($record) {
            return new RecordResource($record, $this->includes);
        })->toArray();
    }
}
