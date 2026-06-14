<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
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
        // 1. Obtenemos el parámetro de la ruta de forma segura ('failure')
        $providerRouteParam = $this->route('failure');

        // 2. Si es objeto extrae el ID, si no, usa el valor directo.
        $provider_id = is_object($providerRouteParam) ? $providerRouteParam->id : $providerRouteParam;

        return [
            'provider_name' => [
                'required',
                'string',
                'min:3',
                'max:150',
                Rule::unique('providers', 'provider_name')->ignore($provider_id)
            ],

            'contact_name' => [
                'required',
                'string',
                'min:3',
                'max:150'
            ],

            'phone_number' => [
                'required',
                'string',
                'min:4',
                'max:16',
                Rule::unique('providers', 'phone_number')->ignore($provider_id)
            ],
        ];
    }
}
