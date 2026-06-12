<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModelRequest extends FormRequest
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

    public function rules(): array
    {

        // 1. Capturamos el parámetro de la ruta de forma segura ('vehicle_model')
        $modelRouteParam = $this->route('vehicle_model');

        // 2. Extraemos el ID con nuestro truco a prueba de errores
        $model_id = is_object($modelRouteParam) ? $modelRouteParam->id : $modelRouteParam;

        return [
            'name' => [
                'required', 'string'
            ]
        ];
    }
}
