<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'start_time',
        'end_time',
        'is_available'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_available' => 'boolean',
    ];

    /**
     * Get the doctor associated with the appointment slot.
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the appointments associated with this slot.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'appointment_slot_id');
    }
} 