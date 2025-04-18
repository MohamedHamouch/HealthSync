<?php

namespace App\Models;

use App\Enums\UserRole;

class Client extends User
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('role', function ($query) {
            $query->where('role', UserRole::CLIENT);
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
        $this->attributes['role'] = UserRole::CLIENT->value;
    }

    /**
     * Get the client's profile.
     */
    public function profile()
    {
        return $this->hasOne(ClientProfile::class, 'user_id');
    }

    /**
     * Get the appointments for the client.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    /**
     * Get the health records for the client.
     */
    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'user_id');
    }

    /**
     * Get the doctors who have appointments with this client.
     */
    public function doctors()
    {
        return User::whereHas('doctorAppointments', function ($query) {
            $query->where('client_id', $this->id);
        })->where('role', UserRole::DOCTOR);
    }

    /**
     * Get all reviews by the client.
     */
    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Appointment::class,
            'client_id',
            'appointment_id'
        );
    }

    /**
     * Get all measurements for the client through health records.
     */
    public function measurements()
    {
        return $this->hasManyThrough(
            Measurement::class,
            HealthRecord::class,
            'user_id',
            'health_record_id'
        );
    }

    /**
     * Get all health record files for the client through health records.
     */
    public function healthRecordFiles()
    {
        return $this->hasManyThrough(
            HealthRecordFile::class,
            HealthRecord::class,
            'user_id',
            'health_record_id'
        );
    }
} 