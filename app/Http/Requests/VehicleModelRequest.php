<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'required',
                'string',
                'min:2',
                'max:150',
                 // Le decimos: "Busca en la tabla vehicle_models, columna name...
                Rule::unique('vehicle_models', 'name')
                    // ...PERO solo busca donde la columna 'brand_id' coincida con la marca que mandó el usuario"
                    ->where('brand_id', $this->input('brand_id'))
                    // e ignora el registro actual si estamos editando
                    ->ignore($model_id)
            ],

            // LLAVE FORANEA (Validacion que la marca exista)
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id' // Verifica que el ID de la marca sea real en la tabla 'brands'
            ]
        ];
    }
}
