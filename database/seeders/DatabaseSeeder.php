<?php

namespace Database\Seeders;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\HealthRecord;
use App\Models\Review;
use Carbon\Carbon;
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
                    
                    // Generate a random appointment date within the next 30 days
                    $appointmentDate = Carbon::now()->addDays(rand(1, 30));
                    $hour = rand(8, 16); // Between 8 AM and 4 PM
                    $minute = [0, 30][rand(0, 1)]; // Either 0 or 30 minutes
                    $appointmentDate->setTime($hour, $minute, 0);
                    
                    // Create appointment 
                    $appointment = Appointment::factory()->create([
                        'doctor_id' => $doctor->id,
                        'client_id' => $client->id,
                        'appointment_date' => $appointmentDate,
                    ]);
                    
                    // Add reviews to completed appointments
                    if ($appointment->status === AppointmentStatus::COMPLETED) {
                        Review::factory()->create([
                            'appointment_id' => $appointment->id,
                        ]);
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
