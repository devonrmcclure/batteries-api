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
			'id' => $this->when($this->id, $this->id),
			'attributes' => [
				'sku' => $this->when($this->sku, $this->sku),
				'description' => $this->when($this->description, $this->description),
				'price' => $this->when($this->unit_price, $this->unit_price),
				'sale_price' => $this->when($this->unit_sale_price, $this->unit_sale_price),
				'pst' => $this->when($this->pst, $this->pst),
				'gst' => $this->when($this->gst, $this->gst),
				'image' => $this->when($this->image, $this->image),
				'brand' => $this->when($this->brand, $this->brand),
				'model' => $this->when($this->model_number, $this->model_number),
				'order_number' => $this->when($this->order_number, $this->order_number),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			'category' => new Category($this->whenLoaded('category')),
			'links' => [
				'self' => route('products.show', ['product' => $this->id]),
			],
		];
	}
}
