<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class RoleRequest extends FormRequest
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

    /**
     * Prepara los datos para la validación.
     * Si 'role_descriptions' viene vacío o nulo, le asignamos el valor por defecto.
     */
    #[Override]
    public function prepareForValidation()
    {
        $this->merge(['role_description' => $this->input('role_description') ?: 'SIN DESCRIPCION']);
    }
    public function rules(): array
    {

    //? Obtenemos el parámetro de la ruta de forma segura ('brand')
        $roleRouteParam = $this->route('role');

        //? Si es objeto (Route Model Binding) extrae el ID, si no, usa el valor directo.
        $role_id = is_object($roleRouteParam) ? $roleRouteParam->id : $roleRouteParam;

        return [
            'name' => ['required', 'string', 'min:3', 'max:100',
            // 3. Ignora el ID actual al actualizar, o no ignora nada al crear (si es nulo)
                Rule::unique('roles', 'name')->ignore($role_id)],

            'role_description' => ['nullable', 'string', 'min:3', 'max:255']
        ];
    }
}
