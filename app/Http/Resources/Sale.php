<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer;
use App\Http\Resources\Staff;
use App\Http\Resources\Location;
use App\Http\Resources\PaymentMethod;
use App\Http\Resources\PartOrder;
use App\Http\Resources\RepairOrder;

class Sale extends JsonResource
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
			'type' => 'sales',
			'id' => $this->when($this->id, $this->id),
			'attributes' => [
				'invoice_number' => $this->when($this->invoice_number, $this->invoice_number),
				'subtotal' => $this->when($this->subtotal, $this->subtotal),
				'pst' => $this->when($this->pst, $this->pst),
				'gst' => $this->when($this->gst, $this->gst),
				'total' => $this->when($this->total, $this->total),
				'items_sold' => $this->when($this->items_sold, $this->items_sold),
				'invoice_comment' => $this->when($this->invoice_comment, $this->invoice_comment),
                'printed' => $this->when($this->printed, $this->printed),
                'duplicate_printed' => $this->when($this->duplicate_printed, $this->duplicate_printed),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
            ],
            'relations' => [
                'staff' => new Staff($this->whenLoaded('staff')),
                'customer' => new Customer($this->whenLoaded('customer')),
                'location' => new Location($this->whenLoaded('location')),
                'payment_method' => new PaymentMethod($this->whenLoaded('paymentMethod')),
                'part_order' => new PartOrder($this->whenLoaded('partOrder')),
                'repair_order' => new RepairOrder($this->whenLoaded('repairOrder'))
            ],
			'links' => [
				'self' => route('sales.show', ['sale' => $this->id]),
			],
		];
    }
}