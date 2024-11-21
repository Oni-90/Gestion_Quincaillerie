<?php

    namespace App\Http\Requests\Product;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateProductRequest extends FormRequest
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
            $id = $this->route('id');
            return [
                'name' => ['string','sometimes',Rule::unique('products','name')->ignore($id)->where(function($query){
                    return $query->where('id',request('id'));
                })],
                'description' => 'string|nullable|max:255',
                'price' => 'decimal:0,4|sometimes',
                'quantity' => 'sometimes|decimal:0,4',
                'unit' => 'string|sometimes',
                'store_location' => 'nullable|string|max:80',
                'alert_threshold' => "sometimes|integer",
                'category_id' => 'integer|nullable|exists:categories,id',
                'slug' => ['string','sometimes',Rule::unique('products','slug')->ignore($id)->where(function($query){
                    return $query->where('id',request('id'));
                })],
            ];
        }

        /**
         * message to show at rule violation
         */
        public function messages()
        {
            return[
                'name.unique' => "Un produit avec ce nom existe déjà.",
                'description.max' => "La description est trop longue.",
                'store_location.max' => "l'emplacement est trop long.",
                'price.decimal' => "Le prix ne doit pas avoir plus de 4 chiffre après la virgule.",
                'quantity.decimal' => "La quantité ne doit pas avoir plus de 4 chiffre après la virgule.",
                'category_id' => "Cette catégorie n'existe pas.",
                'slug.unique' => "il y a déjà un produit avec cet nom abrégé.",
            ];
        }
    }
