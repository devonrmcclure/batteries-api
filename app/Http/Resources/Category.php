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
			'data' => [
				'name' => $this->name,
				'image' => $this->image,
				'ancestors' => $this->collection($this->whenLoaded('grandparents')),
				'descendants' => $this->collection($this->whenLoaded('grandchildren')),
				'parents' => $this->collection($this->whenLoaded('parents')),
				'children' => $this->collection($this->whenLoaded('children')),
				'created_at' => (string)$this->created_at,
				'updated_at' => (string)$this->updated_at
			],
			'status' => 200
		];
    }
}
