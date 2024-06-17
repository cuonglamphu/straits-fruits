<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
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
            'Fruit_Name' => ['required', 'string', 'max:255', 'unique:fruits,Fruit_Name'],
            'Price' => ['required', 'numeric'],
            'Category_ID' => ['required', 'integer'],
            'Unit_ID' => ['required', 'integer'],
        ];
    }

    //handle failed validation
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }
}
