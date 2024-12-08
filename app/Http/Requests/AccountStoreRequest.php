<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
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
            'seller_id' => ['required', 'string'],
            'creation_date' => ['required', 'date'],
            'apps_count' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'seller_id' => ['required', 'string'],
            'creation_date' => ['required', 'date'],
            'apps_count' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'seller_id' => ['required', 'string'],
            'creation_date' => ['required', 'date'],
            'apps_count' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
        ];
    }
}
