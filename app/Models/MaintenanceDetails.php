<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceDetails extends Model
{
    protected $fillable = ['quantity', 'unit_price',
    'spare_part_id', 'maintenance_sheet_id'];

    public function sparePart(): BelongsTo {
        return $this -> belongsTo(SparePart::class, 'spare_part_id');
    }

    public function maintenanceSheet() : BelongsTo {
        return $this -> belongsTo(MaintenanceSheet::class, 'maintenance_sheet_id');
    }
}
