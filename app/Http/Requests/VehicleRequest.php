<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;
use PharIo\Manifest\License;

class VehicleRequest extends FormRequest
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
    #
    #[Override]
    public function prepareForValidation()
    {
        $this->merge([
            'vehicle_observations' => $this->input('vehicle_observations') ?: 'SIN OBSERVACIONES'
        ]);
    }

    public function rules(): array
    {
        // 1. Obtenemos el parámetro de la ruta de forma segura
        $vehicleRouteParam = $this->route('vehicle');

        // 2. Extraemos el ID con nuestro truco a prueba de errores
        $vehicle_id = is_object($vehicleRouteParam) ? $vehicleRouteParam->id : $vehicleRouteParam;

        // Lista exacta de tu CHECK constraint de la base de datos
        $permitted_transmissions = [
            'MANUAL',
            'AUTOMATICA',
            'CONTINUA(CVT)',
            'DOBLE EMBRAGUE(DCT)',
            'AUTOMATIZADA(AMT)',
            'SECUENCIAL',
            'DIRECTA'];

        return [
            'license_plate' => [
                'required',
                'string',
                'min:5',
                'max:20',
                Rule::unique('vehicles', 'license_plate')->ignore($vehicle_id)
            ],
            'model_year' => [
                'required',
                'integer',
                'min:1900',
                'max:'. (date('Y') + 1) //? validacion de que el anio del modelo puede ser como maximo un anio mayor al anio presente
            ],
            'production_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                 'before:today', // no puede ser fabricado en el futuro
                'after:1920-01-01' //Evita fechas sin sentido o muy antiguas
            ],
            'color' => [
                'required',
                'string',
                'min:3',
                'max:50'
            ],
            'engine' => [
                'required',
                'string',
                'min:2',
                'max:100'
            ],
            'transmission' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::in($permitted_transmissions)
            ],
            'vehicle_observations' => [
            'required',
            'string',
            'min:3'
            ],
            'vehicle_model_id' => [
                'required',
                'integer',
                'exists:vehicle_models,id'
            ],
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id'
            ]
        ];
    }
}
