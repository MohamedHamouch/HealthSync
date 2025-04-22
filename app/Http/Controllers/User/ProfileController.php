<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientProfile;
use App\Models\DoctorProfile;
use App\Enums\Gender;
use App\Models\User;
use App\Enums\UserRole;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleString = $user->role->value;

        // Get role-specific data
        $profileData = $this->getProfileDataForRole($user);

        // Return the appropriate view based on role
        return view("{$roleString}.profile", compact('profileData'));
    }

    public function getProfileDataForRole($user)
    {
        // Get base user data
        $userData = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
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
                        'blood_type' => $profile->blood_type,
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

    /**
     * Update the user's basic profile information
     */
    public function updateBasicInfo(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ]);
        
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Basic profile information updated successfully');
    }
    
    /**
     * Update the user's contact information
     */
    public function updateContactInfo(Request $request)
    {
        $user = Auth::user();
        
        // Validate data
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'city' => 'nullable|string|max:100',
        ]);
        
        // Get the profile based on user role
        switch ($user->role->value) {
            case 'client':
                $profile = ClientProfile::where('user_id', $user->id)->first();
                if (!$profile) {
                    // Create a new profile if it doesn't exist
                    $profile = new ClientProfile(['user_id' => $user->id]);
                }
                break;
                
            case 'doctor':
                $profile = DoctorProfile::where('user_id', $user->id)->first();
                if (!$profile) {
                    // Create a new profile if it doesn't exist
                    $profile = new DoctorProfile(['user_id' => $user->id]);
                }
                break;
                
            default:
                return redirect()->route('profile')->with('error', 'Profile not found');
        }
        
        // Update the profile
        $profile->phone = $validated['phone'];
        $profile->city = $validated['city'];
        $profile->save();
        
        return redirect()->route('profile')->with('success', 'Contact information updated successfully');
    }
    
    /**
     * Update the client's health information
     */
    public function updateHealthInfo(Request $request)
    {
        $user = Auth::user();
        
        // Only clients can update health information
        if ($user->role->value !== 'client') {
            return redirect()->route('profile')->with('error', 'Only clients can update health information');
        }
        
        // Validate data
        $validated = $request->validate([
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'blood_type' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'allergies' => 'nullable|string',
            'chronic_conditions' => 'nullable|string',
        ]);
        
        // Get or create client profile
        $profile = ClientProfile::where('user_id', $user->id)->first();
        if (!$profile) {
            $profile = new ClientProfile(['user_id' => $user->id]);
        }
        
        // Update health information
        $profile->date_of_birth = $validated['date_of_birth'];
        if (!empty($validated['gender'])) {
            $profile->gender = Gender::from($validated['gender']);
        }
        $profile->blood_type = $validated['blood_type'];
        $profile->height = $validated['height'];
        $profile->weight = $validated['weight'];
        $profile->allergies = $validated['allergies'];
        $profile->chronic_conditions = $validated['chronic_conditions'];
        $profile->save();
        
        return redirect()->route('profile')->with('success', 'Health information updated successfully');
    }
    
    /**
     * Update the user's profile photo
     */
    public function updateProfilePhoto(Request $request)
    {
        $user = Auth::user();
        
        // Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);
        
        // Delete the old avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        // Store the new avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Profile photo updated successfully');
    }
}
