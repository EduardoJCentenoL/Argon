<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Failure extends Model
{
    protected $fillable = ['name', 'failure_description'];

    public function maintenanceSheets () : HasMany {
        return $this -> hasMany(MaintenanceSheet::class, 'failure_id');
    }
}
