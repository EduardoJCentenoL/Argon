<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['name'];

    // Una marca tiene muchos modelos de vehículos
    public function vehicleModels() : HasMany{
        return $this -> hasMany(VehicleModel::class, 'brand_id');
    }

    // Una marca provee muchos repuestos
    public function spareParts() : HasMany {
        return $this -> hasMany(SparePart::class, 'brand_id');
    }
}
