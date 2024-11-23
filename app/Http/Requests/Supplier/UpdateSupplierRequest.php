<?php

    namespace App\Http\Requests\Supplier;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateSupplierRequest extends FormRequest
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
                'name' => 'sometimes|string|max:80',
                'address' => 'sometimes|string',
                'phone' => ['string','sometimes','max:8','min:8', Rule::unique('suppliers')->ignore($id)->where(function ($query){
                    return $query->where('id', request('id'));
                })],
                'email' => ['string','sometimes', Rule::unique('suppliers')->ignore($id)->where(function ($query){
                    return $query->where('id', request('id'));
                })],
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
                'phone.min' => 'Le numéro de télephone doit contenir au moins 8 chiffres.',
                'phone.max' => 'Le numéro de télephone doit pas excéder 8 chiffres.',
                'phone.unique' => 'Cet numéro  de télephone est déjà utilisé.',
                'email.unique' => 'Cet email est déja utlisé.'
            ];
        }
    }
