<?php
namespace App\Modules\Customer\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
class CustomerListResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {

        return [
            'data' => CustomerListResource::collection($this->collection),

            'total' => $this->total(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'from' => $this->firstItem(),
            'to' => $this->lastItem(),
            'next_page_url' => $this->nextPageUrl(),
            'prev_page_url' => $this->previousPageUrl(),
            'api_resource' => true,
        ];
    }

}
