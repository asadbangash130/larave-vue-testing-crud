<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedCollection extends ResourceCollection
{
    private $resourceClass;

    public function __construct($resource, $resourceClass)
    {
        parent::__construct($resource);

        $this->resource = $this->collectResource($resource);
        $this->resourceClass = $resourceClass;
    }


    public function toArray($request)
    {
        $object_in_collection = collect($this->resource)->toArray();
        return [
            'code' => 200,
            'message'=>'success',
            'status' => 'true',
            'data' => $this->resourceClass::collection($this->collection)->toArray($request),
            'meta' => [
                "current_page"=>$this->currentPage(),
                "from"=>$object_in_collection['from'],
                "last_page" => $this->lastPage(),
                "to" => $object_in_collection['to'],
                "total" => $this->Total(),
                "path"  => $this->path(),
                "next_page_url" => $this->nextPageUrl(),
                "prev_page_url" => $this->previousPageUrl()
            ],
        ];
    }
}
