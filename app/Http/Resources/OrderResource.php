<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'quantity' => $this->quantity,
            'total' => $this->total,
            'delivery_address' => $this->delivery_address,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'products' => $this->products ? $this->products : ''
        ];
    }
}
