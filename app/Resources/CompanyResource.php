<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\IgnitionType;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'logo' => getPhoto($this->image, 'assets/images/default_vehicle.png'),

        ];
        return $data;
    }
}
