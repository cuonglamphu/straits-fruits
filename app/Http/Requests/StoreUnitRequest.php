<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'Unit_Name' => ['required', 'string', 'max:255', 'unique:units,Unit_Name'],
        ];
    }

    public function messages(): array
    {
        return [
            'Unit_Name.required' => 'The unit name is required.',
            'Unit_Name.unique' => 'The unit name has already been taken.',
            'Unit_Name.max' => 'The unit name must not exceed 255 characters.',
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
