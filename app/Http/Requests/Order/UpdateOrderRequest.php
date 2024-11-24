<?php

    namespace App\Http\Requests\Order;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateOrderRequest extends FormRequest
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
                //order data
                'supplier_id' => 'sometimes|integer|exists:suppliers,id',
                'order_date' => 'sometimes|date|before_or_equal:now',
                'payment_status' => 'sometimes|string',

                //product_order data
                'products' => 'array|required',
                'products.*.product_id' => 'sometimes|exists:products,id',
                'products.*.quantity_ordered' => 'sometimes|decimal:0,4|min:1',
            ];
        }

        /**
         * ---------------------------------------------
         * message to show when one rule is violate
         * ---------------------------------------------
         * @return [type]
         */
        public function messages()
        {
            return[
                'order_date.before_or_equal' => "La date doit être antérieure ou égale à aujourd'hui.",
                'products.required' => "Vous devez choisir au moins un produit afin de créer la commande.",
                'product.*.product_id.exists' => "Vous avez selectioné produit qui est introuvable",
                'products.*.quantity_ordered.decimal' => "La quantité ne doit pas avoir plus de 4 chiffres après la virgule.",
                'supplier_id.exists' => "Le fournisseur sélectionné n'existe pas.",
            ];
        }
    }
