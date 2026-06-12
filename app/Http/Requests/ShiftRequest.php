<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShiftRequest extends FormRequest
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
        //? Obtenemos el parámetro de la ruta de forma segura ('brand')
        $shiftRouteParam = $this->route('shift');

        //? Si es objeto (Route Model Binding) extrae el ID, si no, usa el valor directo.
        $shift_id = is_object($shiftRouteParam) ? $shiftRouteParam->id : $shiftRouteParam;

        return [
            'name' => ['required','string', 'min:3', 'max:100',
             // 3. Ignora el ID actual al actualizar, o no ignora nada al crear (si es nulo)
                Rule::unique('shifts', 'name')->ignore($shift_id)
                ],

            'start_time' => [
                'required',
                'date_format:H:i'// Usa 'H:i' si el frontend solo envía horas y minutos (ej: 08:00)
                ],

            'end_time' => [
                'required',
                'date_format:H:i:s',
                'after:date:start_time' // Valida que el turno no termine antes de que empiece
                ]
        ];
    }
}
