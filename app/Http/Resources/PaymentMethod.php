<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Sale;

class PaymentMethod extends JsonResource
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
			'type' => 'payment_methods',
			'id' => $this->when($this->id, $this->id),
			'attributes' => [
				'name' => $this->when($this->name, $this->name),
				'notes' => $this->when($this->notes, $this->notes),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			'links' => [
				'self' => route('payment-methods.show', ['payment_method' => $this->id]),
			],
		];
    }
}
