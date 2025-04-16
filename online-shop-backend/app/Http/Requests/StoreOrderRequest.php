<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'products' => 'nullable|array|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,completed,canceled',
            'shipping_address' => 'required|string|max:255',
        ];
    }
}
