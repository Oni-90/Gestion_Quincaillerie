<?php

    namespace App\Http\Resources\Product;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class ProductResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array
        {
            return [
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'price' => $this->price,
                'store_location' => $this->store_location,
                'alert_threshold' => $this->alert_threshold,
                'unit' => $this->unit,
                'quantity' => $this->quantity,
                'category_name' => $this->category->name,
            ];
        }
    }
