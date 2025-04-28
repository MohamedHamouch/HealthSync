<?php

namespace App\Http\Controllers\Client;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the client's appointments.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $clientId = Auth::id();
        
        $query = Appointment::where('client_id', $clientId);
            
        if ($status) {
            $query->where('status', $status);
        }
        
        $appointments = $query->latest('appointment_date')->paginate(10);
        
        // Load doctor models properly with profiles
        $doctorIds = $appointments->pluck('doctor_id')->unique()->toArray();
        $doctors = Doctor::with('profile')->whereIn('id', $doctorIds)->get()->keyBy('id');
        
        return view('client.appointments.index', compact('appointments', 'doctors'));
    }
    
    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        // Check if the client is authorized to view this appointment
        if ($appointment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Load the doctor model properly
        $doctor = Doctor::with('profile')->find($appointment->doctor_id);
        $appointment->load(['review']);
        
        return view('client.appointments.show', compact('appointment', 'doctor'));
    }
    
    /**
     * Store a review for a completed appointment.
     */
    public function storeReview(Request $request, Appointment $appointment)
    {
        // Check if the client is authorized to review this appointment
        if ($appointment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the appointment is completed
        if ($appointment->status !== AppointmentStatus::COMPLETED) {
            return redirect()->back()->with('error', 'You can only review completed appointments.');
        }
        
        // Check if a review already exists
        if ($appointment->review()->exists()) {
            return redirect()->back()->with('error', 'You have already reviewed this appointment.');
        }
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);
        
        Review::create([
            'appointment_id' => $appointment->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
    
    /**
     * Cancel an appointment.
     */
    public function cancel(Appointment $appointment)
    {
        // Check if the client is authorized to cancel this appointment
        if ($appointment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Only allow cancellation if appointment is pending or confirmed
        if (!in_array($appointment->status, [AppointmentStatus::PENDING, AppointmentStatus::CONFIRMED])) {
            return redirect()->back()->with('error', 'You cannot cancel this appointment.');
        }
        
        $appointment->delete();
        
        return redirect()->route('client.appointments.index')->with('success', 'Appointment cancelled successfully.');
    }
} 