<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaintenanceSheet extends Model
{
    protected $fillable = ['entry_date', 'estimated_delivery_date',
    'current_mileage', 'work_execution_details',
    'sheet_status', 'vehicle_id', 'employee_id',
    'service_type_id', 'failure_id'];

    public function vehicle(): BelongsTo {
        return $this -> belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function employee(): BelongsTo {
        return $this -> belongsTo(Employee::class, 'employee_id');
    }

    public function serviceType(): BelongsTo {
        return $this -> belongsTo(ServiceType::class, 'service_type_id');
    }

    public function fauilure(): BelongsTo {
        return $this -> belongsTo(Failure::class, 'failure_id');
    }

    public function serviceHistory(): HasOne {
        return $this -> hasOne(ServiceHistory::class, 'maintenance_sheet_id');
    }

    public function maintenanceDetails() : HasMany {
        return $this -> hasMany(MaintenanceDetails::class, 'maintenance_sheet_id');
    }
}
