<?php

namespace App\Http\Resources;

use App\Http\Resources\StaffCollection;
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
			'attributes' => [
				'id' => $this->id,
				'name' => $this->when($this->name, $this->name),
				'email' => $this->when($this->email, $this->email),
				'address' => $this->when($this->address, $this->address),
				'phone' => $this->when($this->phone, $this->phone),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			'relations' => [
				'staff' => new StaffCollection($this->whenLoaded('staff'))
			],
			'links' => [
				'self' => route('locations.show', ['locations' => $this->id]),
			],
		];
	}
}
