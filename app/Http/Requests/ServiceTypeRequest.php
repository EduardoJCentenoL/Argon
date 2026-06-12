<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceTypeRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge(['service_description' => $this->input('service_description') ?: 'SIN DESCRIPCION']);
    }

    public function rules(): array
    {
        //? Obtenemos el parámetro de la ruta de forma segura ('brand')
        $sercieTypeRouteParam = $this->route('brand');

        //? Si es objeto (Route Model Binding) extrae el ID, si no, usa el valor directo.
        $service_type_id = is_object($sercieTypeRouteParam) ? $sercieTypeRouteParam->id : $sercieTypeRouteParam;

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                // 3. Ignora el ID actual al actualizar, o no ignora nada al crear (si es nulo)
                Rule::unique('specialties', 'name')->ignore($service_type_id)
            ],
            'service_description' => [
                'nullable',
                'string',
                'min:3',
                'max:255'
            ]
        ];
    }
}
