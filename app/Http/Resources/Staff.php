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
			'id' => $this->id,
			'name' => $this->name,
			'initials' => $this->initials,
			'created' => $this->when($this->created_at, (string) $this->created_at),
			'updated' => $this->when($this->updated_at, (string) $this->updated_at),
			'location' => new Location($this->whenLoaded('location')),
		];
	}
}
