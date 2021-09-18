<?php

namespace App\Modules\Customer\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerEditResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'customer_id' => $this->id,
            'customer_firstname' => $this->customer_firstname,
            'customer_lastname' => $this->customer_lastname,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
        ];

    }
}
