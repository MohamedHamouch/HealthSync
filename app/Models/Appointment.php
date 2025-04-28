<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'client_id',
        'appointment_date',
        'reason',
        'status',
        'notes'
    ];

    protected $casts = [
        'status' => AppointmentStatus::class,
        'appointment_date' => 'datetime',
    ];

    /**
     * Get the doctor associated with the appointment.
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the client associated with the appointment.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get the review associated with the appointment.
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
} 