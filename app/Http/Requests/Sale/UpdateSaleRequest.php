<?php

    namespace App\Http\Requests\Sale;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateSaleRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
            //sale data
            'client_id' => 'nullable|integer|exists:clients,id',
            'payment_status' => 'sometimes|string',

            //product data
            'products' => 'required|array',
            'products.*.product_id' => 'sometimes|integer|exists:products,id',
            'products.*.quantity_sold' => 'sometimes|decimal:0,4',
            ];
        }

        /**
         * -----------------------------------------
         * rule violation message
         * -----------------------------------------
         * @return [type]
         */
        public function messages()
        {
            return[
                'client_id.exists' => "Le client que vous tentez d'associer a cette vente n'existe pas.",
                'products.*.quantity_sold' => "Vous devez spécifier la quantité vendu pour chaque produit.",
                'products.required' => "Vous devez obligatoirement associé un produit à chaque vente.",
                'product.array' => "Vous devez obligatoirement associé un produit à chaque vente.",
            ];
        }
    }
