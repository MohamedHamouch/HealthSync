<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Models\Client;
use App\Models\ClientProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'client@healthsync.com',
            'username' => 'jane.doe',
            'password' => Hash::make('password'),
            'role' => UserRole::CLIENT,
            'is_active' => true,
            'is_suspended' => false,
        ]);

        ClientProfile::create([
            'user_id' => $client->id,
            'date_of_birth' => '1990-05-15',
            'phone' => '555-987-6543',
            'city' => 'Chicago',
            'gender' => Gender::FEMALE,
            'height' => 165.0,
            'weight' => 65.0,
            'allergies' => 'Penicillin, Peanuts',
            'chronic_conditions' => 'Asthma',
        ]);
    }
} 