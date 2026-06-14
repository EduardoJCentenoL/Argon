<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class MaintenanceSheetRequest extends FormRequest
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


    // #[Override]
    // public function prepareForValidation()
    // {
    //     $this->merge([
    //         'work_execution_details' => $this->input('work_execution_details') ?: 'SIN DETALLES'
    //     ]);
    // }

    public function rules(): array
    {
        // Lista exacta de tu CHECK constraint de la base de datos
        $sheet_status_list = [
            "RECEPCIONADO",
            "DIAGNOSTICO",
            "EN_ESPERA",
            "EN_PROCESO",
            "COMPLETADO",
            "ENTREGADO",
            "RECHAZADO"];

        return [
            'entry_date' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s', // Cambiar a 'Y-m-d\TH:i' si usas input datetime-local
                'after:1920-01-01' //Evita fechas sin sentido o muy antiguas
            ],

            'estimated_delivery_date' => [
                'required',
                'date',
                 'date_format:Y-m-d H:i:s', // Debe coincidir con el formato de entry_date
                'after_or_equal:entry_date'
            ],

            'current_mileage' => [
                'required',
                'integer',
                'min:0'
            ],

            'work_execution_details' => [
                'required',
                'string',
                'min:2'
            ],

            'sheet_status' => [
                'required',
                'string',
                Rule::in($sheet_status_list)
            ],

            'vehicle_id' => [
                'required',
                'integer',
                'exists:vehicles,id'
            ],

            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id'
            ],

            'service_type_id' => [
                'required',
                'integer',
                'exists:service_types,id'
            ],

            'failure_id' => [
                'required',
                'integer',
                'exists:failures,id'
            ]
        ];
    }
}
