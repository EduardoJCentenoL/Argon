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
        return true;
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
        $sercieTypeRouteParam = $this->route('service_type');

        //? Si es objeto (Route Model Binding) extrae el ID, si no, usa el valor directo.
        $service_type_id = is_object($sercieTypeRouteParam) ? $sercieTypeRouteParam->id : $sercieTypeRouteParam;

        // Lista exacta de tu CHECK constraint de la base de datos
        $permitted_types = ['Preventivo', 'Correctivo'];

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                // 3. Ignora el ID actual al actualizar, o no ignora nada al crear (si es nulo)
                Rule::unique('service_types', 'name')->ignore($service_type_id),
                Rule::in($permitted_types)
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
