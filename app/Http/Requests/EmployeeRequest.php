<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        //? 1. Obtenemos el paramtetro de la ruta de forma segura
        $employeeRouteParam = $this->route('employee');

        // 2. Extraemos el ID con nuestro truco a prueba de errores
        $employee_id = is_object($employeeRouteParam) ? $employeeRouteParam->id : $employeeRouteParam;
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:100'
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
                'before:today',
                'after:1920-01-01'
            ],
            'doc_number' => [
                    'required',
                    'string',
                    'min:5',
                    'max:16',
                    Rule::unique('employees', 'doc_number')->ignore($employee_id)
                ],
                'email_address' => [
                    'required',
                    'string',
                    'max:150',
                    Rule::unique('employees', 'email_address')->ignore($employee_id)
                ],
                'is_active' => [
                    'sometimes',
                    'boolean'
                ],
            'specialty_id' => [
                'required',
                'integer',
                'exists:specialties,id'
            ],
            'shift_id' => [
                'required',
                'integer',
                'exists:shifts,id'
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
        ];
    }
}
