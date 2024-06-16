<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateFruitRequest extends FormRequest
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
            'Fruit_Name' => ['required', 'string', 'max:255','unique:fruits,Fruit_Name'],
            'Price' => ['required', 'numeric'],
            'Category_ID' => ['required', 'integer'],
            'Unit_ID' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'Fruit_Name.required' => 'The fruit name is required.',
            'Fruit_Name.unique' => 'The fruit name has already been taken.',
            'Fruit_Name.max' => 'The fruit name must not exceed 255 characters.',
            'Price.required' => 'The price is required.',
            'Category_Id.required' => 'The category is required.',
            'Unit_Id.required' => 'The unit is required.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator) : void
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
