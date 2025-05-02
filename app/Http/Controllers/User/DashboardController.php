<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Services\UserService;
use App\Models\HealthRecord;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleString = $user->role->value;

        $user = UserService::resolveUserInstance($user);

        // Get role-specific data
        $dashboardData = $this->getDashboardDataForRole($user);

        // Return the appropriate view based on role
        return view("{$roleString}.dashboard", compact('dashboardData'));
    }

    private function getDashboardDataForRole(User $user)
    {
        Log::info('Getting dashboard data for user with role: ' . $user->role->value);

        switch ($user->role->value) {
            case 'admin':
                return [
                    'totalUsers' => User::count(),
                    'totalDoctors' => User::where('role', 'doctor')->count(),
                    'totalClients' => User::where('role', 'client')->count(),
                    'totalAppointments' => 25, // Static count for demo
                    'inactiveDoctors' => User::where('role', 'doctor')->where('is_active', false)->where('is_suspended', false)->count(),
                    'recentUsers' => User::latest()->take(5)->get(),
                ];

            case 'doctor':
                $doctor = $user;
                $todayAppointments = $doctor->appointments()
                    ->whereDate('appointment_date', now()->toDateString())
                    ->count();
                
                $totalPatients = $doctor->appointments()
                    ->distinct('client_id')
                    ->count('client_id');
                
                $pendingAppointments = $doctor->appointments()
                    ->where('status', 'pending')
                    ->count();
                
                $activeScheduleDays = $doctor->schedules()
                    ->where('is_active', true)
                    ->count();
                
                $upcomingAppointments = $doctor->appointments()
                    ->with('client')
                    ->whereDate('appointment_date', '>=', now()->toDateString())
                    ->orderBy('appointment_date')
                    ->take(5)
                    ->get();
                
                $recentPatients = User::whereIn('id', function($query) use ($doctor) {
                    $query->select('client_id')
                        ->from('appointments')
                        ->where('doctor_id', $doctor->id)
                        ->distinct();
                })
                ->latest()
                ->take(5)
                ->get();
                
                // Add review statistics
                $reviewCount = Review::whereHas('appointment', function ($query) use ($doctor) {
                    $query->where('doctor_id', $doctor->id);
                })->count();
                
                $averageRating = 0;
                if ($reviewCount > 0) {
                    $averageRating = Review::whereHas('appointment', function ($query) use ($doctor) {
                        $query->where('doctor_id', $doctor->id);
                    })->avg('rating');
                }
                
                return [
                    'todayAppointments' => $todayAppointments,
                    'totalPatients' => $totalPatients,
                    'pendingAppointments' => $pendingAppointments,
                    'activeScheduleDays' => $activeScheduleDays,
                    'upcomingAppointments' => $upcomingAppointments,
                    'recentPatients' => $recentPatients,
                    'reviewCount' => $reviewCount,
                    'averageRating' => $averageRating,
                ];

            case 'client':
                // Get health records data using defined relationships
                $healthRecordsCount = $user->healthRecords()->count();
                $recentHealthRecords = $user->healthRecords()
                    ->latest()
                    ->take(3)
                    ->get();

                // Get appointments data
                $appointmentsCount = $user->appointments()->count();
                $upcomingAppointments = $user->appointments()
                    ->with('doctor')
                    ->whereDate('appointment_date', '>=', now()->toDateString())
                    ->orderBy('appointment_date')
                    ->take(3)
                    ->get();
                $upcomingAppointmentsCount = $user->appointments()
                    ->whereDate('appointment_date', '>=', now()->toDateString())
                    ->count();
                    
                // Get recent doctors the client has appointments with
                $recentDoctors = User::whereIn('id', function($query) use ($user) {
                    $query->select('doctor_id')
                        ->from('appointments')
                        ->where('client_id', $user->id)
                        ->distinct();
                })
                ->latest()
                ->take(5)
                ->get();

                // Return client dashboard data
                return [
                    'healthRecordsCount' => $healthRecordsCount,
                    'recentHealthRecords' => $recentHealthRecords,
                    'appointmentsCount' => $appointmentsCount,
                    'upcomingAppointments' => $upcomingAppointments,
                    'upcomingAppointmentsCount' => $upcomingAppointmentsCount,
                    'recentDoctors' => $recentDoctors
                ];

            default:
                Log::warning('Unknown role for dashboard: ' . $user->role->value);
                return [];
        }
    }

    public function homePage()
    {
        return view('home');
    }
}