<?php

namespace App\Http\Resources;

use App\Http\Resources\Location;
use Illuminate\Http\Resources\Json\JsonResource;

class Staff extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'staff',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'initials' => $this->initials,
                'location' => new Location($this->whenLoaded('location')),
            ],
            'links' => [
                'self' => route('staff.show', ['staff' => $this->id]),
            ],
        ];
    }
}
