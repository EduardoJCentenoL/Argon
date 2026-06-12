<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    protected $fillable = ['name', 'specialty_description'];

    public function employees () : HasMany {
        return $this -> hasMany(Employee::class, 'specialty_id');
    }
}
