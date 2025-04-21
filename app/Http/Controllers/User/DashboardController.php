<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleString = strtolower($user->role->value);

        // Get role-specific data
        $dashboardData = $this->getDashboardDataForRole($user);
        
        // Return the appropriate view based on role
        return view("{$roleString}.dashboard");
    }
    
    private function getDashboardDataForRole($user)
    {
        switch($user->role) {
            case 'admin':
                return [
                    'totalUsers' => User::count(),
                    'totalDoctors' => User::where('role', 'doctor')->count(),
                    'totalClients' => User::where('role', 'client')->count(),
                    // Add more admin-specific data
                ];
            
            case 'doctor':
                return [
                    'upcomingAppointments' => $user->appointments()->upcoming()->get(),
                    'totalPatients' => $user->patients()->count(),
                    // Add more doctor-specific data
                ];
            
            case 'client':
                return [
                    'nextAppointment' => $user->appointments()->next()->first(),
                    'recentPrescriptions' => $user->prescriptions()->recent()->get(),
                    // Add more client-specific data
                ];
            
            default:
                return [];
        }
    }

    public function homePage()
    {
        return view('home');
    }
}