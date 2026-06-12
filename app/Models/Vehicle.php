<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = ['license_plate', 'model_year', 'production_date',
    'color', 'engine', 'transmission', 'vehicle_observations',
    'vehicle_model_id', 'customer_id'];

    public function vehicleModel(): BelongsTo {
        return $this -> belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function customer(): BelongsTo {
        return $this -> belongsTo(Customer::class, 'customer_id');
    }

    public function maintenanceSheets(): HasMany {
        return $this -> hasMany(MaintenanceSheet::class, 'vehicle_id');
    }

    public function serviceHistories() : HasMany {
        return $this -> hasMany(ServiceHistory::class, 'vehicle_id');
    }

}
