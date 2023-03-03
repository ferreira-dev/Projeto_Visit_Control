<?php

namespace App\Http\Requests\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresa extends FormRequest
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
            'nome'              => ['required', 'string', 'min:3', 'max:100'],
            'cnpj'              => ['required', 'string', 'max:14'],
            'contato'           => ['required', 'numeric', 'min:10', 'max:11'],
            'user_create_id'    => ['required'],
        ];
    }
}
