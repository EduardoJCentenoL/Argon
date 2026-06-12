<?php

return [
    'require' => 'El campo :attribute es obligatorio.',
    'date' => 'El campo :attribute no es una fecha valida.',
    'date_format' => 'El campo :attribute debe cumplir con el formato :format.',
    'string' => 'El campo :atribute debe ser una cadena de texto.',
    'after_or_equal' => 'La :attribute debe ser una fecha posterior o igual a :date.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'in' => 'El valor seleccionado para :attribute no es un estado válido.',
    'exists' => 'El elemento seleccionado para :attribute no existe en el sistema.',
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'numeric' => 'El campo :attribute debe ser un número decimal o entero.',
    'decimal' => 'El campo :attribute debe tener entre :decimal decimales.',

    // Separación inteligente de mínimos (min) según el tipo de dato
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
    ],

    // Separación inteligente de máximos (max) según el tipo de dato
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe contener más de :max caracteres.',
    ],

    //? Traduccion para el nombre de los campos en la db
    // Traducción de los nombres de los parámetros al español en los errores
    'attributes' => [
        'entry_date' => 'fecha de entrada',
        'estimated_delivery_date' => 'fecha estimada de entrega',
        'current_mileage' => 'kilometraje actual',
        'work_execution_details' => 'detalles del trabajo',
        'sheet_status' => 'estado de la hoja',
        'vehicle_id' => 'vehículo',
        'employee_id' => 'empleado',
        'service_type_id' => 'tipo de servicio',
        'failure_id' => 'falla reportada',
        'total_cost' => 'costo total',
        'is_urgent' => 'prioridad urgente',
    ],
];
