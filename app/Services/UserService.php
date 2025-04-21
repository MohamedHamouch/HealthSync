<?php

namespace App\Services;

use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Client;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Get a user instance by ID, cast to the appropriate class based on role
     */
    public static function getUserById($id)
    {
        $user = User::find($id);
        return static::resolveUserInstance($user);
    }

    /**
     * Get the currently authenticated user, cast to the appropriate class based on role
     */
    public static function getCurrentUser()
    {
        $user = Auth::user();
        return static::resolveUserInstance($user);
    }

    /**
     * Resolve a user instance to its correct role-specific class
     */
    public static function resolveUserInstance($user)
    {
        if (!$user)
            return null;

        return match ($user->role) {
            UserRole::ADMIN => $user instanceof Admin ? $user : new Admin($user->getAttributes()),
            UserRole::DOCTOR => $user instanceof Doctor ? $user : new Doctor($user->getAttributes()),
            UserRole::CLIENT => $user instanceof Client ? $user : new Client($user->getAttributes()),
            default => $user,
        };
    }
}