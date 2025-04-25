<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Models\Client;
use App\Models\ClientProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'first_name' => 'Robert',
                'last_name' => 'Smith',
                'email' => 'robert.smith@example.com',
                'username' => 'robert.smith',
                'date_of_birth' => '1985-03-12',
                'phone' => '555-123-4567',
                'city' => 'New York',
                'gender' => Gender::MALE,
                'height' => 178.0,
                'weight' => 80.5,
                'allergies' => 'Shellfish',
                'chronic_conditions' => 'Hypertension',
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Garcia',
                'email' => 'maria.garcia@example.com',
                'username' => 'maria.garcia',
                'date_of_birth' => '1992-07-24',
                'phone' => '555-234-5678',
                'city' => 'Los Angeles',
                'gender' => Gender::FEMALE,
                'height' => 165.0,
                'weight' => 58.0,
                'allergies' => 'Pollen, Dust',
                'chronic_conditions' => 'Asthma',
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Johnson',
                'email' => 'james.johnson@example.com',
                'username' => 'james.johnson',
                'date_of_birth' => '1978-11-05',
                'phone' => '555-345-6789',
                'city' => 'Chicago',
                'gender' => Gender::MALE,
                'height' => 182.0,
                'weight' => 90.0,
                'allergies' => 'Penicillin',
                'chronic_conditions' => 'Diabetes Type 2',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Brown',
                'email' => 'emily.brown@example.com',
                'username' => 'emily.brown',
                'date_of_birth' => '1988-05-17',
                'phone' => '555-456-7890',
                'city' => 'Houston',
                'gender' => Gender::FEMALE,
                'height' => 170.0,
                'weight' => 65.0,
                'allergies' => 'None',
                'chronic_conditions' => 'None',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'email' => 'michael.davis@example.com',
                'username' => 'michael.davis',
                'date_of_birth' => '1975-09-30',
                'phone' => '555-567-8901',
                'city' => 'Phoenix',
                'gender' => Gender::MALE,
                'height' => 175.0,
                'weight' => 78.0,
                'allergies' => 'Nuts',
                'chronic_conditions' => 'Arthritis',
            ],
            [
                'first_name' => 'Jessica',
                'last_name' => 'Wilson',
                'email' => 'jessica.wilson@example.com',
                'username' => 'jessica.wilson',
                'date_of_birth' => '1990-12-15',
                'phone' => '555-678-9012',
                'city' => 'Philadelphia',
                'gender' => Gender::FEMALE,
                'height' => 163.0,
                'weight' => 57.0,
                'allergies' => 'Lactose',
                'chronic_conditions' => 'Migraine',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Martinez',
                'email' => 'david.martinez@example.com',
                'username' => 'david.martinez',
                'date_of_birth' => '1982-02-28',
                'phone' => '555-789-0123',
                'city' => 'San Antonio',
                'gender' => Gender::MALE,
                'height' => 180.0,
                'weight' => 85.0,
                'allergies' => 'Sulfa Drugs',
                'chronic_conditions' => 'Hyperthyroidism',
            ],
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Taylor',
                'email' => 'jennifer.taylor@example.com',
                'username' => 'jennifer.taylor',
                'date_of_birth' => '1986-08-10',
                'phone' => '555-890-1234',
                'city' => 'San Diego',
                'gender' => Gender::FEMALE,
                'height' => 168.0,
                'weight' => 62.0,
                'allergies' => 'None',
                'chronic_conditions' => 'None',
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Anderson',
                'email' => 'christopher.anderson@example.com',
                'username' => 'christopher.anderson',
                'date_of_birth' => '1980-04-05',
                'phone' => '555-901-2345',
                'city' => 'Dallas',
                'gender' => Gender::MALE,
                'height' => 185.0,
                'weight' => 88.0,
                'allergies' => 'None',
                'chronic_conditions' => 'Hypertension',
            ],
        ];

        foreach ($clients as $clientData) {
            $client = User::create([
                'first_name' => $clientData['first_name'],
                'last_name' => $clientData['last_name'],
                'email' => $clientData['email'],
                'username' => $clientData['username'],
                'password' => Hash::make('password'),
                'role' => UserRole::CLIENT,
                'is_active' => true,
                'is_suspended' => false,
            ]);

            ClientProfile::create([
                'user_id' => $client->id,
                'date_of_birth' => $clientData['date_of_birth'],
                'phone' => $clientData['phone'],
                'city' => $clientData['city'],
                'gender' => $clientData['gender'],
                'height' => $clientData['height'],
                'weight' => $clientData['weight'],
                'allergies' => $clientData['allergies'],
                'chronic_conditions' => $clientData['chronic_conditions'],
            ]);
        }
    }
} 