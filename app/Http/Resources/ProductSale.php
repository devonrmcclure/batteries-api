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
            'invoice' => $this->when($this->invoice_number, $this->invoice_number),
            'product_id' => $this->pivot->product_id,
            'sku' => $this->when($this->pivot->sku, $this->pivot->sku),
            'price' => $this->when($this->pivot->price, $this->pivot->price),
            'description' => $this->when($this->pivot->description, $this->pivot->description),
            'quantity' => $this->pivot->quantity,
            'extended' => $this->pivot->extended,
            'pst' => $this->pivot->pst,
            'gst' => $this->pivot->gst,
            'total' => $this->when($this->pivot->total, $this->pivot->total),
            'comment' => $this->when($this->pivot->comment, $this->pivot->comment),
            'created' => (string) $this->created_at,
            'updated' => (string) $this->updated_at

        ];
    }
}
