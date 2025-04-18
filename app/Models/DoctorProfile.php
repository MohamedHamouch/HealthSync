<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorProfile extends Model
{
    use HasFactory;
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

    /**
     * Get the user that owns the doctor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointment slots for the doctor.
     */
    public function appointmentSlots()
    {
        return $this->hasMany(AppointmentSlot::class, 'doctor_id', 'user_id');
    }

    /**
     * Get the appointments for the doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'user_id');
    }
}
