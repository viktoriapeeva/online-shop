<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource; 
use App\Http\Resources\UserResource;

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
            'products' => $this->products,
            'total_price' => $this->total_price,
            'shipping_address' => $this->shipping_address,
            'status' => $this->status,
            'user' => $this->user
        ];
    }
}
