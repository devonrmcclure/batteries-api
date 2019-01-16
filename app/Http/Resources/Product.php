<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	public function toArray($request) {
		return [
			'type' => 'products',
			'id' => $this->id,
			'attributes' => [
				'sku' => $this->sku,
				'description' => $this->description,
				'price' => $this->unit_price,
				'sale_price' => $this->unit_sale_price,
				'pst' => $this->pst,
				'gst' => $this->gst,
				'image' => $this->image
			],
			'category' => new Category($this->whenLoaded('category')),
			'links' => [
				'self' => route('products.show', ['product' => $this->id]),
			],
		];
	}
}
