<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class ServiceHistoryRequest extends FormRequest
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


    #[Override]
    public function prepareForValidation()
    {
        // Convertimos los valores a números flotantes para sumarlos de forma segura
        $labor = (float) $this->input('labor_cost', 0);
        $spare = (float) $this->input('spare_parts_cost', 0);

        $this->merge([
            'recomendations' => $this->input('recomendations') ?: 'SIN RECOMENDACIONES',

            //? Calcula el total solo para que el usuario no tenga que digitarlo
            'total_cost' => $labor +$spare
        ]);
    }

    public function rules(): array
    {
        return [
            'completion_date' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
            ],

            'labor_cost' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                'decimal:0,2'
            ],

            'spare_parts_cost' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                'decimal:0,2'
            ],

            'total_cost' => [
                'required',
                'numeric',
                'min:0',
                'max:1999999.98',
                'decimal:0,2'
            ],

            'recomendations' => [
                'required',
                'string',
                'min:3'
            ],

            'vehicle_id' => [
                'required',
                'integer',
                'exists:vehicles,id'
            ],

            'maintenance_sheet_id' => [
                'required',
                'integer',
                'exists:maintenance_sheets,id'
            ]
        ];
    }
}
