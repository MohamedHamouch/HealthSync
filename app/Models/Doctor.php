<?php

namespace App\Models;

use App\Enums\UserRole;

class Doctor extends User
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('role', function ($query) {
            $query->where('role', UserRole::DOCTOR);
        });
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['role'] = UserRole::DOCTOR->value;
    }

    /**
     * Get the doctor's profile.
     */
    public function profile()
    {
        return $this->hasOne(DoctorProfile::class, 'user_id');
    }

    /**
     * Get the clients that have granted this doctor access to their data.
     */
    public function authorizedClients()
    {
        return $this->belongsToMany(Client::class, 'client_doctor', 'doctor_id', 'client_id')
            ->withPivot(['access_granted_at', 'access_expires_at', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Get the appointments for the doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * Get the doctor's weekly schedules.
     */
    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    /**
     * Get the clients who have appointments with this doctor.
     */
    public function clients()
    {
        return User::whereHas('clientAppointments', function ($query) {
            $query->where('doctor_id', $this->id);
        })->where('role', UserRole::CLIENT);
    }

    /**
     * Get all reviews received by the doctor.
     */
    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Appointment::class,
            'doctor_id',
            'appointment_id'
        );
    }

    /**
     * Calculate the average rating from reviews.
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}