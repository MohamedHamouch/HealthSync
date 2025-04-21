<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Doctor;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = User::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'doctor@healthsync.com',
            'username' => 'john.smith',
            'password' => Hash::make('password'),
            'role' => UserRole::DOCTOR,
            'is_active' => true,
            'is_suspended' => false,
        ]);

        DoctorProfile::create([
            'user_id' => $doctor->id,
            'specialization' => 'Cardiology',
            'bio' => 'Experienced cardiologist with 10 years of practice.',
            'office_address' => '123 Medical Plaza, Suite 456, New York, NY',
            'office_phone' => '555-123-4567',
            'consultation_fee' => 150.00,
        ]);
    }
} 