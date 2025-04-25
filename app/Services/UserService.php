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

        if ($user instanceof Admin || $user instanceof Doctor || $user instanceof Client) {
            return $user;
        }

        $roleModel = match ($user->role) {
            UserRole::ADMIN => new Admin(),
            UserRole::DOCTOR => new Doctor(),
            UserRole::CLIENT => new Client(),
            default => $user,
        };

        if ($roleModel === $user) {
            return $user;
        }

        // Manually copy attributes from the base User model to the role-specific model
        foreach ($user->attributesToArray() as $key => $value) {
            $roleModel->setAttribute($key, $value);
        }

        // Make sure the ID is set correctly
        $roleModel->id = $user->id;

        return $roleModel;
    }

    /**
     * Create a new user with the specified role
     */
    public static function createUser(array $data, UserRole $role)
    {
        $userData = array_merge($data, ['role' => $role]);

        $user = match ($role) {
            UserRole::ADMIN => Admin::create($userData),
            UserRole::DOCTOR => Doctor::create($userData),
            UserRole::CLIENT => Client::create($userData),
            default => User::create($userData),
        };

        return $user;
    }
}