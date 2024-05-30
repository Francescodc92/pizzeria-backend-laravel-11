<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PizzaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_image_path' => $this->full_image_path,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percent' => $this->discount_percent,
            'price_after_discount' => $this->price_after_discount,
        ];
    }
}
