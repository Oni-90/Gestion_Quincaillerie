<?php

    namespace App\Http\Requests\Order;

    use Illuminate\Foundation\Http\FormRequest;

    class OrderRequest extends FormRequest
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
                'supplier_id' => 'required|integer|exists:suppliers,id',
                'order_date' => 'required|date|before_or_equal:now',
                'payment_status' => 'sometimes|string',

                //product_order data
                'products' => 'array|required',
                'products.*.product_id' => 'required|exists:products,id',
                'products.*.quantity_ordered' => 'required|decimal:0,4|min:1',
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
                'order_date.required' => 'La date de la commande est requise.',
                'products.required' => "Vous devez choisir au moins un produit afin de créer la commande.",
                'products.array' => "Vous devez choisir au moins un produit afin de créer la commande.",
                'products.*.product_id.exists' => "Vous avez selectioné produit qui est introuvable.",
                'products.*.quantity_ordered.required' => "La quantité commandée est requise pour chaque produit.",
                'supplier_id.exists' => "Le fournisseur sélectionné n'existe pas.",
                'supplier_id.required' => "Vous devez sélectionner un fournisseur.",
            ];
        }
    }
