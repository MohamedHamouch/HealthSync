<?php

namespace Database\Seeders;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\HealthRecord;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call default user seeders first
        $this->call([
            AdminSeeder::class,
            DoctorSeeder::class,
            ClientSeeder::class,
        ]);

        // Create additional users if needed
        if (Doctor::count() < 5) {
            $this->call(DoctorSampleSeeder::class);
        }
        
        if (Client::count() < 10) {
            $this->call(ClientSampleSeeder::class);
        }

        // Generate appointment slots for each doctor
        $doctors = Doctor::all();
        foreach ($doctors as $doctor) {
            // Create 20 appointment slots per doctor
            AppointmentSlot::factory()
                ->count(20)
                ->create(['doctor_id' => $doctor->id]);
        }

        // Create client-doctor relationships
        DB::table('client_doctor')->truncate();
        foreach (Client::all() as $client) {
            // Assign 1-3 doctors to each client
            $randomDoctors = Doctor::inRandomOrder()->take(rand(1, 3))->pluck('id');
            
            foreach ($randomDoctors as $doctorId) {
                DB::table('client_doctor')->insert([
                    'client_id' => $client->id,
                    'doctor_id' => $doctorId,
                    'access_granted_at' => now(),
                    'access_expires_at' => now()->addMonths(rand(3, 12)),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Create appointments
        foreach (Client::all() as $client) {
            // Create 2-5 appointments per client
            $appointmentCount = rand(2, 5);
            
            $doctors = $client->authorizedDoctors;
            if ($doctors->count() > 0) {
                for ($i = 0; $i < $appointmentCount; $i++) {
                    $doctor = $doctors->random();
                    $slot = AppointmentSlot::where('doctor_id', $doctor->id)
                        ->where('is_available', true)
                        ->inRandomOrder()
                        ->first();
                    
                    if ($slot) {
                        // Create appointment and mark slot as unavailable
                        $appointment = Appointment::factory()->create([
                            'doctor_id' => $doctor->id,
                            'client_id' => $client->id,
                            'appointment_slot_id' => $slot->id,
                        ]);
                        
                        $slot->update(['is_available' => false]);
                        
                        // Add reviews to completed appointments
                        if ($appointment->status === AppointmentStatus::COMPLETED) {
                            Review::factory()->create([
                                'appointment_id' => $appointment->id,
                            ]);
                        }
                    }
                }
            }
        }

        // Create health records with measurements
        foreach (Client::all() as $client) {
            // Create 2-4 health records per client
            HealthRecord::factory()
                ->count(rand(2, 4))
                ->create(['user_id' => $client->id]);
        }
    }
}
