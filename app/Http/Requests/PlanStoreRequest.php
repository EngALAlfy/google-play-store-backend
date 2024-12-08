<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:max=255'],
            'price' => ['required', 'string'],
            'name' => ['required', 'string', 'max:max=255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'accounts_count' => ['required', 'string'],
            'old_accounts' => ['required'],
        ];
    }
}
