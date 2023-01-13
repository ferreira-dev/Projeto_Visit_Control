<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password'    => ['required', 'min:4', 'max:16'],
            'email'       => ['required', 'email', 'max:25'],
            'device_name' => ['required', 'min:4', 'max:200'],
        ];
    }
}
