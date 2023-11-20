<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'first_name' => 'string|min:5|max:100',
            'last_name' =>'string|min:5|max:100',
            'email' => 'email',
            'password' => 'nullable|string|min:8',
              'bio'=>'min:10|max:100'
        ];
    }
}
