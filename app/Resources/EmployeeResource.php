<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\IgnitionType;

class EmployeeResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'first name' => $this->first_name,
            'last name' => $this->last_name,
            'company' => isset($this->company) ? $this->company->name : '',
            'email' => $this->email,
            'phone' => $this->phone,

        ];
        return $data;
    }
}
