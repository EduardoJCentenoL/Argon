<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SparePartRequest extends FormRequest
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
        // 1. Obtenemos el parámetro de la ruta de forma segura
        $sparePartRouteParam = $this->route('spare_part');

        // 2. Extraemos el ID con nuestro truco a prueba de errores
        $spare_part_id = is_object($sparePartRouteParam) ? $sparePartRouteParam->id : $sparePartRouteParam;
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:50'
            ],
            'sku' => [
                'required',
                'string',
                'max:50',
                Rule::unique('spare_parts', 'sku')->ignore($spare_part_id)
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:65535'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                'decimal:0,2'
            ],
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id'
            ],
            'provider_id' => [
                'required',
                'integer',
                'exists:providers,id'
            ]
        ];
    }
}
