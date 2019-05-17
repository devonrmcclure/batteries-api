<?php

namespace App\Http\Resources;

use App\Http\Resources\Staff;
use App\Http\Resources\Customer;
use App\Http\Resources\Location;
use App\Http\Resources\SaleCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RepairOrder extends JsonResource
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
			'type' => 'repair_orders',
			'id' => $this->when($this->id, $this->id),
			'attributes' => [
                'order_number' => $this->when($this->order_number, $this->order_number),
                'warranty' => $this->when($this->is_warranty, $this->is_warranty),
                'warranty_type' => $this->when($this->warranty_type, $this->warranty_type),
                'call_if_over' => $this->when($this->call_if_over, $this->call_if_over),
				'referred_by' => $this->when($this->referred_by, $this->referred_by),
				'brand' => $this->when($this->brand, $this->brand),
				'model' => $this->when($this->model, $this->model),
				'type' => $this->when($this->type, $this->type),
				'date_code' => $this->when($this->date_code, $this->date_code),
				'condition' => $this->when($this->condition, $this->condition),
                'accessories' => $this->when($this->accessories, $this->accessories),
                'customer_problem' => $this->when($this->customer_problem, $this->customer_problem),
                'store_notes' => $this->when($this->store_notes, $this->store_notes),
                'technician_notes' => $this->when($this->technician_notes, $this->technician_notes),
				'to_ho' => $this->when($this->to_ho, $this->to_ho),
				'from_ho' => (string)$this->from_ho,
                'picked_up' => (string)$this->picked_up,
                'created' => (string)$this->created_at,
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
            ],
            'relations' => [
                'staff' => new Staff($this->whenLoaded('staff')),
                'customer' => new Customer($this->whenLoaded('customer')),
                'location' => new Location($this->whenLoaded('location')),
                'sales' => new SaleCollection($this->whenLoaded('sales'))
            ],
			'links' => [
				'self' => route('repair-orders.show', ['repair_order' => $this->id]),
			],
		];
    }
}
