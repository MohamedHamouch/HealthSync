<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show the doctor cards with filtering options
     */
    public function index(Request $request)
    {
        $query = Doctor::with('profile', 'reviews');
        
        // Filter by specialization if provided
        if ($request->has('specialization') && $request->specialization) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('specialization', $request->specialization);
            });
        }
        
        $doctors = $query->get();
        
        // Get list of specializations for the filter
        $specializations = Doctor::join('doctor_profiles', 'users.id', '=', 'doctor_profiles.user_id')
            ->select('doctor_profiles.specialization')
            ->distinct()
            ->pluck('specialization')
            ->filter()
            ->values();
            
        return view('client.booking.doctors', compact('doctors', 'specializations'));
    }
    
    /**
     * Show doctor details with booking form
     */
    public function doctor($id)
    {
        // Load doctor with profile and schedules but WITHOUT reviews.client relation
        $doctor = Doctor::with(['profile', 'schedules'])
            ->findOrFail($id);
            
        // Calculate average rating
        $averageRating = $doctor->reviews->avg('rating') ?: 0;
        
        // Get active days for the doctor
        $activeDays = $doctor->schedules()
            ->where('is_active', true)
            ->pluck('day_of_week')
            ->toArray();
            
        // Get reviews with appointment and client data
        $reviews = $doctor->reviews()
            ->with('appointment.client')
            ->latest()
            ->take(3)
            ->get();
            
        return view('client.booking.doctor-detail', 
            compact('doctor', 'averageRating', 'activeDays', 'reviews'));
    }
    
    /**
     * Check doctor's availability for a specific date
     */
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
        ]);
        
        $doctorId = $validated['doctor_id'];
        $date = $validated['date'];
        
        // Get doctor details with profile
        $doctor = Doctor::with('profile')
            ->findOrFail($doctorId);
            
        // Get day of week (1-7, Monday-Sunday)
        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;
        
        // Get doctor's schedule for this day
        $schedule = $doctor->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->first();
            
        // Get booked appointments for that day
        $bookedTimeSlots = [];
        if ($schedule) {
            $appointmentDate = Carbon::parse($date);
            $bookings = Appointment::where('doctor_id', $doctorId)
                ->whereDate('appointment_date', $appointmentDate->format('Y-m-d'))
                ->get();
                
            foreach ($bookings as $booking) {
                $bookedTime = Carbon::parse($booking->appointment_date)->format('H:i');
                $bookedTimeSlots[] = $bookedTime;
            }
        }
            
        $formattedDate = Carbon::parse($date)->format('l, F j, Y');
        
        return view('client.booking.availability', compact('doctor', 'date', 'formattedDate', 'schedule', 'bookedTimeSlots'));
    }
    
    /**
     * Show doctor's schedule page
     * 
     * @param int $doctorId
     * @return \Illuminate\View\View
     */
    public function schedule($doctorId, Request $request)
    {
        $doctor = Doctor::with('profile')->findOrFail($doctorId);
        
        // If date is provided, redirect to availability check
        if ($request->has('date')) {
            return $this->checkAvailability($request);
        }
        
        // Get active days for the doctor
        $activeDays = $doctor->schedules()
            ->where('is_active', true)
            ->pluck('day_of_week')
            ->toArray();
            
        return view('client.booking.schedule', compact('doctor', 'activeDays'));
    }
    
    /**
     * Create a new appointment
     */
    public function storeAppointment(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'reason' => 'required|string|max:500',
        ]);
        
        $clientId = Auth::id();
        $doctorId = $validated['doctor_id'];
        
        // Create appointment date from date and time
        $appointmentDate = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        
        // Check if slot is available (not double booked)
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $appointmentDate->format('Y-m-d'))
            ->whereTime('appointment_date', $appointmentDate->format('H:i:s'))
            ->exists();
            
        if ($existingAppointment) {
            return redirect()->back()
                ->with('error', 'This time slot is no longer available. Please select another time.')
                ->withInput();
        }
        
        // Create the appointment
        Appointment::create([
            'doctor_id' => $doctorId,
            'client_id' => $clientId,
            'appointment_date' => $appointmentDate,
            'reason' => $validated['reason'],
            'status' => AppointmentStatus::PENDING,
        ]);
        
        return redirect()->route('client.appointments.index')
            ->with('success', 'Appointment booked successfully. It is awaiting confirmation from the doctor.');
    }
} 