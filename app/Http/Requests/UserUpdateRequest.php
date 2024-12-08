<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:unique|email|max=255'],
            'name' => ['required', 'string', 'max:max=255'],
            'email' => ['required', 'email', 'max:unique|email|max=255'],
            'password' => ['required', 'password', 'max:confirmed|min=8'],
            'photo' => ['required', 'string', 'max:nullable|max=2048'],
            'facebook' => ['required', 'string', 'max:nullable|max=255'],
            'whatsapp' => ['required', 'string', 'max:nullable|max=15|regex'],
            'phone' => ['required', 'string', 'max:nullable|max=15|regex'],
            'website' => ['required', 'string', 'max:nullable|url|max=255'],
        ];
    }
}
