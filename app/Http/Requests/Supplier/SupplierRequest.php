<?php

    namespace App\Http\Requests\Supplier;

    use Illuminate\Foundation\Http\FormRequest;

    class SupplierRequest extends FormRequest
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
                'name' => 'required|string|max:80',
                'address' => 'required|string',
                'phone' => 'required|string|min:8|max:8|unique:suppliers,phone',
                'email' => 'required|string|unique:suppliers,email',
            ];
        }

        /**
         * --------------------------------------------
         * rule violation messages
         * -------------------------------------------- 
         * @return [type]
         */
        public function messages()
        {
            return[
                'name.required' => 'Le nom du fournisseur est requis.',
                'phone.min' => 'Le numéro de télephone doit contenir au moins 8 chiffres.',
                'phone.max' => 'Le numéro de télephone doit pas excéder 8 chiffres.',
                'phone.unique' => 'Cet numéro  de télephone est déjà utilisé.',
                'phone.required' => 'Le numéro de téléphone est reuis.',
                'address.required' => 'L\'adresse est requise.',
                'email.required' => 'L\'email est requis.',
                'email.unique' => 'Cet email est déja utlisé.'
            ];
        }
    }
