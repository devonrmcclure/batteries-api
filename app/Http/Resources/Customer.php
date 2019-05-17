<?php

namespace App\Http\Resources;

use App\Http\Resources\Location;
use App\Http\Resources\PartOrderCollection;
use App\Http\Resources\RepairOrderCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
			'type' => 'customers',
			'id' => $this->id,
			'attributes' => [
				'name' => $this->name,
				'phone' => $this->phone,
				'address' => $this->when($this->address, $this->address),
				'city' => $this->when($this->city, $this->city),
				'province' => $this->when($this->province, $this->province),
				'country' => $this->when($this->country, $this->country),
				'email' => $this->when($this->email, $this->email),				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			'relations' => [
				'location' => new Location($this->whenLoaded('location')),
				'part_orders' => new PartOrderCollection($this->whenLoaded('partOrders')),
				'repair_orders' => new RepairOrderCollection($this->whenLoaded('repairOrders'))
			],
			'links' => [
				'self' => route('customers.show', ['customer' => $this->id]),
			],
		];
	}
}
