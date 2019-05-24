<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSale extends JsonResource
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
			'type' => 'product-sale',
			'id' => $this->when($this->pivot->id, $this->pivot->id),
			'attributes' => [
				'sku' => $this->when($this->pivot->sku, $this->pivot->sku),
                'price' => $this->when($this->pivot->price, $this->pivot->price),
                'description' => $this->when($this->pivot->description, $this->pivot->description),
                'quantity' => $this->when($this->pivot->quantity, $this->pivot->quantity),
                'extended' => $this->when($this->pivot->extended, $this->pivot->extended),
				'pst' => $this->when($this->pivot->pst, $this->pivot->pst),
				'gst' => $this->when($this->pivot->gst, $this->pivot->gst),
                'total' => $this->when($this->pivot->total, $this->pivot->total),
                'comment' => $this->when($this->pivot->comment, $this->pivot->comment),
                'sale_type' => $this->when($this->pivot->sale_type, $this->pivot->sale_type)
            ]
		];
    }
}
