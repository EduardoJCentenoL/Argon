<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleModel extends Model
{
    protected $fillable = ['name', 'brand_id'];

    public function brand(): BelongsTo {
        return $this -> belongsTo(Brand::class, 'brand_id');
    }

    public function vehicles(): HasMany {
        return $this -> hasMany(Vehicle::class, 'vehicle_model_id');
    }
}
