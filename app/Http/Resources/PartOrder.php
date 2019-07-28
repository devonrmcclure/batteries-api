<?php

namespace App\Http\Resources;

use App\Http\Resources\Staff;
use App\Http\Resources\Customer;
use App\Http\Resources\Location;
use App\Http\Resources\SaleCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PartOrder extends JsonResource
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

				'id' => $this->when($this->id, $this->id),
				'order_number' => $this->when($this->order_number, $this->order_number),
				'referred_by' => $this->when($this->referred_by, $this->referred_by),
				'brand' => $this->when($this->brand, $this->brand),
				'model' => $this->when($this->model, $this->model),
				'item' => $this->when($this->item, $this->item),
				'part_number' => $this->when($this->part_number, $this->part_number),
				'part_description' => $this->when($this->part_description, $this->part_description),
				'notes' => $this->when($this->notes, $this->notes),
				'to_ho' => $this->when($this->to_ho, $this->to_ho),
				'from_ho' => (string)$this->from_ho,
                'picked_up' => (string)$this->picked_up,
                'created' => (string)$this->created_at,
				'updated' => $this->when($this->updated_at, (string)$this->updated_at),
				'staff' => new Staff($this->whenLoaded('staff')),
				'customer' => new Customer($this->whenLoaded('customer')),
				'location' => new Location($this->whenLoaded('location')),
				'sales' => new SaleCollection($this->whenLoaded('sales'))

		];
    }
}
