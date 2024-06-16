<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Illuminate\Contracts\Validation\Validator;
class StoreInvoiceRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'Customer_Name' => 'required|string|max:255',
            'Total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.fruit_id' => 'required|exists:fruits,id',
            'items.*.Quantity' => 'required|integer|min:1',
            'items.*.Amount' => 'required|numeric'
        ];
    }

    //message
    public function messages() : array
    {
        return [
            'Customer_Name.required' => 'The customer name is required.',
            'Customer_Name.string' => 'The customer name must be a string.',
            'Customer_Name.max' => 'The customer name must not exceed 255 characters.',
            'Total.required' => 'The total is required.',
            'Total.numeric' => 'The total must be a number.',
            'items.required' => 'The items are required.',
            'items.array' => 'The items must be an array.',
            'items.*.fruit_id.required' => 'The fruit ID is required.',
            'items.*.fruit_id.exists' => 'The selected fruit ID is invalid.',
            'items.*.Quantity.required' => 'The quantity is required.',
            'items.*.Quantity.integer' => 'The quantity must be an integer.',
            'items.*.Quantity.min' => 'The quantity must be at least 1.',
            'items.*.Amount.required' => 'The amount is required.',
            'items.*.Amount.numeric' => 'The amount must be a number.'
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
