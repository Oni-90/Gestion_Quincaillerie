<?php

    namespace App\Http\Requests\Client;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateClientRequest extends FormRequest
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
                
                /**
                 * user data validation
                 */
                'email' => ['string','sometimes', Rule::unique('users')->ignore($id)->where(function ($query){
                    return $query->where('id', request('id'));
                })],
                'password' => 'string|sometimes|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$&*?!%]/',
                'firstname' => 'string|sometimes|max:80',
                'lastname' => 'string|sometimes|max:80',
                'phone' => ['string','sometimes','max:8','min:8', Rule::unique('users')->ignore($id)->where(function ($query){
                    return $query->where('id', request('id'));
                })],
                /**
                 * manager data validation
                 */
                'address' => 'sometimes|string',
            ];
        }

        /**
         * get message to show for any rule violation
         * @return [type]
         */
        public function messages()
        {
            return [
                'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
                'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
                // 'password.confirmed' => 'Les mots de passe ne correspondent pas.',
                'phone.min' => 'Le numéro de télephone doit contenir au moins 8 chiffres.',
                'phone.max' => 'Le numéro de télephone doit pas excéder 8 chiffres.',
                'phone.unique' => 'Cet numéro existe deja dans la base de données.',
                'email.unique' => 'Cet email existe deja dans la base de données.',
            ];
        }
    }
