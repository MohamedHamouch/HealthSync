<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'office_address',
        'office_phone',
        'consultation_fee'
    ];

    protected $casts = [
        'consultation_fee' => 'decimal:2',
    ];
}
