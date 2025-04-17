<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'phone',
        'city',
        'gender',
        'height',
        'weight',
        'allergies',
        'chronic_conditions'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'height' => 'float',
        'weight' => 'float',
    ];

}
