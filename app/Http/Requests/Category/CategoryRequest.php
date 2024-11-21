<?php

    namespace App\Http\Requests\Category;

    use Illuminate\Foundation\Http\FormRequest;

    class CategoryRequest extends FormRequest
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
                'name' => 'required|string|unique:categories,name',
                'description' => 'nullable|string|max:255',
            ];
        }

        /**
         * message to show at rule violation
         */
        public function messages()
        {
            return [
                'name.unique' => "Une catégorie avec ce nom existe déjà.",
                "name.required" => "Le nom est requis.",
                'description.max' => "La description est trop longue."
            ];
        }
    }
