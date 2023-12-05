<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // ///manipulate the Order class what to returen.
    public function toArray(Request $request): array
    {
        // return [
        //     "id" => $this->id,
        //     "name" => $this->name,
        //     "email" => $this->email,
        //     "total" => $this->admin_revenue ?? 0, // Use null coalescing operator
        //     "order_items" => OrderItemResource::collection($this->whenLoaded('orderItems')),
        // ];

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            // "total" => $this->admin_revenue,
            "order_items" => OrderItemResource::collection($this->whenLoaded("orderItems")),
        ];
        // return parent::toArray($request);
    }
}
