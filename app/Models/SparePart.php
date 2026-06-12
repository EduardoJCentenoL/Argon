<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SparePart extends Model
{
    protected $fillable = ['name', 'sku', 'stock', 'price', 'brand_id', 'provider_id'];

    public function brand() : BelongsTo {
        return $this -> belongsTo(Brand::class, 'brand_id');
    }

    public function provider() : BelongsTo {
        return $this -> belongsTo(Provider::class, 'provider_id');
    }

    public function maintenanceDetails() : HasMany {
        return $this -> hasMany(MaintenanceDetails::class, 'spare_part_id');
    }
}
