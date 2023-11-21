<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            //
            'name' => 'string|min:5|max:100',
            'username' => [
                'string',
                'min:5',
                'max:100',
                Rule::unique('users')->ignore(Auth::user()->username, 'username'),
            ],
            'email' => 'email',
            'password' => 'nullable|min:8',
            'bio' => 'min:10|max:100',
        ];
    }
}
