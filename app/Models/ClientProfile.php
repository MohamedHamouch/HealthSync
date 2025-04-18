<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Gender;

class ClientProfile extends Model
{
    use HasFactory;
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
        'gender' => Gender::class,
    ];

    /**
     * Get the user that owns the client profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointments for the client.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'user_id');
    }

    /**
     * Get the health records for the client.
     */
    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'user_id', 'user_id');
    }
}
