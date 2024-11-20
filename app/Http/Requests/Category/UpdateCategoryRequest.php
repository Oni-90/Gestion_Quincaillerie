<?php

    namespace App\Http\Requests\Category;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateCategoryRequest extends FormRequest
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
                'name' => ['sometimes','string',Rule::unique('categories','name')->ignore($id)->where(function($query){
                    return $query->where('id',request('id'));
                })],
                'description' => 'nullable|string|max:255',
            ];
        }
    }
