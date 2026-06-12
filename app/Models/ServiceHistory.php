<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceHistory extends Model
{
    protected $fillable = ['completion_date', 'labor_cost',
    'spare_parts_cost', 'total_cost', 'recomendations', 'vehicle_id',
    'maintenance_sheet_id'];

    public function vehicle(): BelongsTo {
        return $this -> belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function maintenanceSheet(): BelongsTo{
        return $this -> belongsTo(MaintenanceSheet::class, 'maintenance_sheet_id');
    }
}
