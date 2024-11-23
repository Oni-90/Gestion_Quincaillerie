<?php

namespace App\Http\Resources\Order;

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
            //order data
            'supplier_name' => $this->supplier->name,
            'total_amount' => $this->total_amount,
            'order_date' => $this->order_date,
            'payment_status' => $this->payment_status,
            'order_number' => $this->order_number,

            //product and pivot data
            'products' => $this->products,
        ];
    }
}
