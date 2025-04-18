<?php

namespace App\Models;

use App\Enums\UserRole;

class Admin extends User
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('role', function ($query) {
            $query->where('role', UserRole::ADMIN);
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
        $this->attributes['role'] = UserRole::ADMIN->value;
    }

    /**
     * Get all users.
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get all doctors.
     */
    public function getAllDoctors()
    {
        return User::where('role', UserRole::DOCTOR)->get();
    }

    /**
     * Get all clients.
     */
    public function getAllClients()
    {
        return User::where('role', UserRole::CLIENT)->get();
    }
} 