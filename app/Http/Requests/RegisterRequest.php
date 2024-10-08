<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class RegisterRequest extends BaseRequest
{
    use PasswordValidationRules;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'profile_photo_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
