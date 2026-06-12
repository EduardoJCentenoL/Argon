<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'gender',
    'age', 'doc_number', 'email_address', 'phone_number', 'address'];

    public function vehicles(): HasMany {
        return $this -> hasMany(Vehicle::class, 'customer_id');
    }
}
