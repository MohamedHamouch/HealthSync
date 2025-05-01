<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;

class ScheduleController extends Controller
{
    /**
     * Display doctor's weekly schedule
     */
    public function index()
    {
        $doctorId = Auth::id();
        
        // Initialize the weekday names for easy reference
        $dayNames = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];
        
        // Get existing schedules
        $existingSchedules = DoctorSchedule::where('doctor_id', $doctorId)
            ->get()
            ->keyBy('day_of_week');
        
        // Create a complete schedule with defaults for missing days
        $schedules = [];
        foreach ($dayNames as $dayNumber => $dayName) {
            if (isset($existingSchedules[$dayNumber])) {
                $schedules[$dayNumber] = $existingSchedules[$dayNumber];
            } else {
                // Create a default schedule for this day
                $schedules[$dayNumber] = new DoctorSchedule([
                    'doctor_id' => $doctorId,
                    'day_of_week' => $dayNumber,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'slot_duration' => 60,
                    'is_active' => true,
                ]);
            }
        }
        
        return view('doctor.schedules.index', [
            'schedules' => $schedules,
            'dayNames' => $dayNames
        ]);
    }
    
    /**
     * Update or create schedule for a specific day
     */
    public function updateDay(Request $request, $dayOfWeek)
    {
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration' => 'required|integer|in:30,60',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $request->has('is_active');
        $validated['doctor_id'] = Auth::id();
        $validated['day_of_week'] = $dayOfWeek;
        
        // Find existing or create new
        DoctorSchedule::updateOrCreate(
            [
                'doctor_id' => Auth::id(),
                'day_of_week' => $dayOfWeek
            ],
            $validated
        );
        
        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }
    
    /**
     * Update all days at once
     */
    public function updateAll(Request $request)
    {
        $validated = $request->validate([
            'days.*.start_time' => 'required|date_format:H:i',
            'days.*.end_time' => 'required|date_format:H:i|after:days.*.start_time',
            'days.*.slot_duration' => 'required|integer|in:30,60',
            'days.*.is_active' => 'boolean',
        ]);
        
        foreach ($validated['days'] as $dayOfWeek => $dayData) {
            DoctorSchedule::updateOrCreate(
                [
                    'doctor_id' => Auth::id(),
                    'day_of_week' => $dayOfWeek
                ],
                [
                    'start_time' => $dayData['start_time'],
                    'end_time' => $dayData['end_time'],
                    'slot_duration' => $dayData['slot_duration'],
                    'is_active' => isset($dayData['is_active']),
                    'doctor_id' => Auth::id(),
                    'day_of_week' => $dayOfWeek
                ]
            );
        }
        
        return redirect()->route('doctor.schedules.index')
            ->with('success', 'All schedules updated successfully.');
    }
    
    /**
     * Check if a doctor is available on a specific date
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
        ]);
        
        $doctorId = $request->doctor_id;
        $date = $request->date;
        
        // Convert date to day of week (1-7, Monday-Sunday)
        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;
        
        // Get doctor's schedule for this day
        $schedule = DoctorSchedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->first();
            
        if (!$schedule) {
            return response()->json([
                'available' => false,
                'message' => 'Doctor is not available on this date.',
            ]);
        }
        
        return response()->json([
            'available' => true,
            'schedule' => $schedule,
        ]);
    }
} 