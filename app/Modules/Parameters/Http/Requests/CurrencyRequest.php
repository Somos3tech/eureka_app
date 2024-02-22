<?php

namespace App\Modules\Parameters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'abrev' => 'required|min:2|unique:currencies',
            'description' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'abrev.required' => 'Denominación es Requerida',
            'abrev.unique' => 'Denominación ya registrada',
            'abrev.min' => 'Denominación debe ser minimo de 2 caracteres',
            'description.required' => 'Nombre Divisa es Requerida',
            'description.min' => 'Nombre de Divisa debe ser minimo de 3 caracteres',
        ];
    }
}
