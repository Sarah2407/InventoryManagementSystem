<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'source_store_id' => 'required|exists:stores,id',
            'destination_store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'quantity_requested' => 'required|integer|min:1',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }
}
