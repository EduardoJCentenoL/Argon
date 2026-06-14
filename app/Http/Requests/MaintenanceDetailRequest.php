<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceDetailRequest extends FormRequest
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
        return [
            'quantity' => [
                'required',
                'integer',
                'min:0'
            ],

            'unit_price' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:0'
            ],

            'spare_part_id' => [
                'required',
                'integer',
                'exists:spare_parts,id'
            ],

            'maintenance_sheet_id' => [
                'required',
                'integer',
                'exists:maintenance_sheets,id'
            ]
        ];
    }
}
