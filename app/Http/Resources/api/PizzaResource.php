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
            'fullImagePath' => $this->full_image_path,
            'description' => $this->description,
            'price' => $this->price,
            'available' => $this->available,
            'discountPercent' => $this->discount_percent,
            'priceAfterDiscount' => $this->price_after_discount,
            'quantity' => $this->whenPivotLoaded('order_pizza', function () {
                return $this->pivot->quantity;
            }),
        ];
    }
}
