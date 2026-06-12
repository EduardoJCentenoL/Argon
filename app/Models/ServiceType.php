<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    protected $fillable = ['name', 'service_description'];

    public function maintenanceSheets () : HasMany {
        return $this -> hasMany(MaintenanceSheet::class, 'service_type_id');
    }
}
