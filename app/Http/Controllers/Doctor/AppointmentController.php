<?php

namespace App\Http\Controllers\Doctor;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $doctorId = Auth::id();
        
        $query = Appointment::with(['client'])
            ->where('doctor_id', $doctorId);
            
        if ($status) {
            $query->where('status', $status);
        }
        
        $appointments = $query->latest('appointment_date')->paginate(10);
        
        return view('doctor.appointments.index', compact('appointments'));
    }
    
    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        // Check if the doctor is authorized to view this appointment
        if ($appointment->doctor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Load relationships
        $appointment->load(['client']);
        
        // Get client profile
        $clientUser = $appointment->client;
        $client = Client::find($clientUser->id);
        if ($client) {
            $client->load('profile');
            
            // Get the latest health record for the client with its files
            $latestHealthRecord = $client->healthRecords()->with('files')->latest()->first();
        }
        
        return view('doctor.appointments.show', compact('appointment', 'client', 'latestHealthRecord'));
    }
    
    /**
     * Update the status of an appointment.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        // Check if the doctor is authorized to update this appointment
        if ($appointment->doctor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'status' => 'required|in:' . implode(',', array_column(AppointmentStatus::cases(), 'value')),
        ]);
        
        $appointment->update([
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
} 