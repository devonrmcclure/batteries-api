<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
			'type' => 'categories',
			'id' => $this->id,
			'attributes' => [
				'name' => $this->when($this->name, $this->name),
				'image' => $this->when($this->image, $this->image),
				'created' => $this->when($this->created_at, (string)$this->created_at),
				'updated' => $this->when($this->updated_at, (string)$this->updated_at)
			],
			'grandparents' => $this->collection($this->whenLoaded('grandparents')),
			'grandchildren' => $this->collection($this->whenLoaded('grandchildren')),
			'parents' => $this->collection($this->whenLoaded('parents')),
			'children' => $this->collection($this->whenLoaded('children')),
			'links' => [
				'self' => route('categories.show', ['categories' => $this->id]),
			],
		];
	}
}
