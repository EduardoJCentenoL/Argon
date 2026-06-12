<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    protected $fillable = ['company_name', 'contact_name', 'phone_number'];

    public function spareParts() : HasMany {
        return $this -> hasMany(SparePart::class, 'provider_id');
    }
}
