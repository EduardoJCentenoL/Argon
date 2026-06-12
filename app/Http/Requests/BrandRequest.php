<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
        //? Obtenemos el parámetro de la ruta de forma segura ('brand')
        $brandRouteParam = $this->route('brand');

        //? Si es objeto (Route Model Binding) extrae el ID, si no, usa el valor directo.
        $brand_id = is_object($brandRouteParam) ? $brandRouteParam->id : $brandRouteParam;


        return [
            'name' => ['required', 'string', 'min:3', 'max:100',
            // 3. Ignora el ID actual al actualizar, o no ignora nada al crear (si es nulo)
                Rule::unique('brands', 'name')->ignore($brand_id)]
        ];
    }
}
