<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'buyer_id' => ['required', 'string'],
            'total_price' => ['required', 'string'],
            'buyer_id' => ['required', 'string'],
            'seller_id' => ['required', 'string'],
            'account_id' => ['required', 'string'],
            'broker_id' => ['required', 'string'],
            'total_price' => ['required', 'string'],
        ];
    }
}
