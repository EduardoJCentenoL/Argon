<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        // 1. Obtenemos el parámetro de la ruta de forma segura
        $customerRouteParam = $this->route('customer');

        // 2. Extraemos el ID con nuestro truco a prueba de errores
        $customer_id = is_object($customerRouteParam) ? $customerRouteParam->id : $customerRouteParam;
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:50'
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:50'
            ],
            'gender' => [
                'required',
                'string',
                Rule::in(['M', 'F'])
            ],
            'birth_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:today', // Evita que pongan fechas de nacimiento del futuro
                'after:1920-01-01' //Evita fechas sin sentido o muy antiguas
            ],
            ''
        ];
    }
}
