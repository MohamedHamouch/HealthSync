<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientProfile;
use App\Models\Doctor;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:client,doctor',
            // Client specific fields
            'phone' => 'required_if:role,client|nullable|string|max:255',
            // Doctor specific fields
            'specialization' => 'required_if:role,doctor|nullable|string|max:255',
            'consultation_fee' => 'required_if:role,doctor|nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare user data
        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => strtolower($request->first_name . '.' . $request->last_name),
            'is_active' => true,
            'is_suspended' => false,
        ];

        // Convert string role to UserRole enum
        $role = $request->role === 'client' ? UserRole::CLIENT : UserRole::DOCTOR;
        
        // Create user with UserService
        $user = \App\Services\UserService::createUser($userData, $role);

        // Create role-specific profile
        if ($role === UserRole::CLIENT) {
            $profile = new ClientProfile([
                'user_id' => $user->id,
                'phone' => $request->phone,
            ]);
            $profile->save();
        } elseif ($role === UserRole::DOCTOR) {
            $profile = new DoctorProfile([
                'user_id' => $user->id,
                'specialization' => $request->specialization,
                'consultation_fee' => $request->consultation_fee,
            ]);
            $profile->save();
        }

        // Login the user after registration
        Auth::login($user);

        // Flash success message
        session()->flash('success', 'Registration successful! Welcome to HealthSync.');

        return redirect()->route('dashboard');
    }

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = User::find(Auth::id());

            return redirect()->route('dashboard')->with([
                'success' => 'Login successful! Welcome back, ' . $user->first_name . '!',
            ]);

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}