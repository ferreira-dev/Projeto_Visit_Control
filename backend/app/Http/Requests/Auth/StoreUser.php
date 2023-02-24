<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUser extends FormRequest
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
            'name'        => ['required', 'string', 'min:3', 'max:100'],
            'email'       => ['required', 'email', 'max:255'],
            'password'    => ['required', Password::defaults(), 'max:16'],
            'group'       => ['required', 'string'],
            'image'       => ['required', 'string'],
            'documento'   => ['required', 'string', 'min:11'],
            'contato'     => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:50']
        ];
    }
}
