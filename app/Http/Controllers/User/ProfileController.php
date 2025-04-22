<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientProfile;
use App\Models\DoctorProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleString = $user->role->value;

        // Get role-specific data
        $profileData = $this->getProfileDataForRole($user);

        // Return the appropriate view based on role
        return view("{$roleString}.dashboard", compact('profileData'));
    }

    public function getProfileDataForRole($user)
    {
        // Get base user data
        $userData = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'username' => $user->username,
            'role' => $user->role->value,
            'avatar' => $user->avatar,
            'created_at' => $user->created_at,
        ];

        // Get role-specific profile data
        switch ($user->role->value) {
            case 'client':
                $profile = ClientProfile::where('user_id', $user->id)->first();
                if ($profile) {
                    $userData['profile'] = [
                        'date_of_birth' => $profile->date_of_birth,
                        'phone' => $profile->phone,
                        'city' => $profile->city,
                        'gender' => $profile->gender,
                        'height' => $profile->height,
                        'weight' => $profile->weight,
                        'allergies' => $profile->allergies,
                        'chronic_conditions' => $profile->chronic_conditions,
                    ];
                }
                break;

            case 'doctor':
                $profile = DoctorProfile::where('user_id', $user->id)->first();
                if ($profile) {
                    $userData['profile'] = [
                        'specialization' => $profile->specialization,
                        'bio' => $profile->bio,
                        'office_address' => $profile->office_address,
                        'office_phone' => $profile->office_phone,
                        'consultation_fee' => $profile->consultation_fee,
                    ];
                }
                break;

            case 'admin':
                // Admins don't have additional profile data
                break;
        }

        return $userData;
    }

}
