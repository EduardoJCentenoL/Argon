<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class FailureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    #[Override]
    public function prepareForValidation()
    {
        $this -> merge([
            'failure_description' => $this -> input('failure_description' ?: 'SIN DESCRIPCION')
        ]);
    }
    public function rules(): array
    {
        // 1. Obtenemos el parámetro de la ruta de forma segura ('failure')
        $failureRouteParam = $this->route('failure');

        // 2. Si es objeto extrae el ID, si no, usa el valor directo.
        $failure_id = is_object($failureRouteParam) ? $failureRouteParam->id : $failureRouteParam;

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('failures', 'name')->ignore($failure_id)
            ],

            'failure_description' => [
                'required',
                'string',
                'min:5'
            ],
        ];
    }
}
