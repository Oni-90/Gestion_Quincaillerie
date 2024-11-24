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
                //sale data
                'client_name' => $this->client->user->firstname,
                'sale_number' => $this->sale_number,
                'payment_status' => $this->payment_status,
                'total_amount' => $this->total_amount,

                //product data
                'products' => $this-> products,
            ];
        }
    }
