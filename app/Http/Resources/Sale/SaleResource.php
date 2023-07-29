<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'product' => $this->product->name,
            'amount' => $this->amount,
            'seller' => $this->seller->name,
            'total' => $this->total,
            'created_at' => $this->created_at,
        ];
    }
}
