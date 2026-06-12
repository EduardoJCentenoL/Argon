<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = ['first_names', 'last_names', 'gender',
    'gender', 'age', 'doc_number', 'email_address'];

    //Cast obligatorio para tratar el bit/boolean de la DB de manera nativa en PHP
    protected $casts = ['is_active' => 'boolean',];

    public function role(): BelongsTo {
        return $this -> belongsTo(Role::class, 'role_id');
    }

    public function shift() : BelongsTo {
        return $this -> belongsTo(Shift::class, 'shift_id');
    }

    public function specialty() : BelongsTo {
        return $this -> belongsTo(Specialty::class, 'specialty_id');
    }

    public function maintenanceSheets() : HasMany {
        return $this -> hasMany(MaintenanceSheet::class, 'employee_id');
    }
}
