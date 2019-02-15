<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
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
			'type' => 'locations',
			'id' => $this->id,
			'attributes' => [
				'name' => $this->when($this->name, $this->name),
				'email' => $this->when($this->email, $this->email),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			//'staff' => $this->collection($this->whenLoaded('staff')),
			'links' => [
				'self' => route('locations.show', ['locations' => $this->id]),
			],
		];
    }
}
