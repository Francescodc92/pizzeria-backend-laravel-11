<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'orderDateForHuman' => $this->order_date_forHumans,
            'orderStatusTranslated' => $this->order_statuses,
            'status' => $this->status,
            'address' => new AddressResource($this->address),
            'pizzas' => PizzaResource::collection($this->pizzas),
            'user' => new UserResource($this->user),
            'orderPrice' => $this->order_price
        ];
    }
}
