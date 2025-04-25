<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Doctor;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@healthsync.com',
                'username' => 'sarah.johnson',
                'specialization' => 'Pediatrics',
                'bio' => 'Pediatrician with 12 years of experience specializing in newborn care and childhood development.',
                'office_address' => '456 Children\'s Avenue, Chicago, IL',
                'office_phone' => '555-789-0123',
                'consultation_fee' => 125.00,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@healthsync.com',
                'username' => 'michael.chen',
                'specialization' => 'Neurology',
                'bio' => 'Neurologist focusing on cognitive disorders and brain health with 15 years of clinical practice.',
                'office_address' => '789 Neuron Street, Suite 301, Boston, MA',
                'office_phone' => '555-234-5678',
                'consultation_fee' => 200.00,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Rodriguez',
                'email' => 'emily.rodriguez@healthsync.com',
                'username' => 'emily.rodriguez',
                'specialization' => 'Dermatology',
                'bio' => 'Board-certified dermatologist specializing in skin cancer detection and cosmetic procedures.',
                'office_address' => '123 Skin Lane, Los Angeles, CA',
                'office_phone' => '555-345-6789',
                'consultation_fee' => 175.00,
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Williams',
                'email' => 'david.williams@healthsync.com',
                'username' => 'david.williams',
                'specialization' => 'Orthopedics',
                'bio' => 'Orthopedic surgeon specializing in sports injuries and joint replacements with 10 years of experience.',
                'office_address' => '567 Joint Drive, Denver, CO',
                'office_phone' => '555-456-7890',
                'consultation_fee' => 180.00,
            ],
        ];

        foreach ($doctors as $doctorData) {
            $doctor = User::create([
                'first_name' => $doctorData['first_name'],
                'last_name' => $doctorData['last_name'],
                'email' => $doctorData['email'],
                'username' => $doctorData['username'],
                'password' => Hash::make('password'),
                'role' => UserRole::DOCTOR,
                'is_active' => true,
                'is_suspended' => false,
            ]);

            DoctorProfile::create([
                'user_id' => $doctor->id,
                'specialization' => $doctorData['specialization'],
                'bio' => $doctorData['bio'],
                'office_address' => $doctorData['office_address'],
                'office_phone' => $doctorData['office_phone'],
                'consultation_fee' => $doctorData['consultation_fee'],
            ]);
        }
    }
} 