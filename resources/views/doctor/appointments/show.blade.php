@extends('layouts.app')

@section('title', 'Appointment Details - HealthSync')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 bg-primary-700 text-white shadow-lg hidden md:block">
        <div class="p-6 border-b border-primary-600">
            <h2 class="text-2xl font-semibold">Doctor Portal</h2>
        </div>
        <nav class="mt-6">
            <ul>
                <li class="py-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-2 hover:bg-primary-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('doctor.appointments.index') }}" class="flex items-center px-6 py-2 bg-primary-800 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Appointments
                    </a>
                </li>
                <li class="py-2">
                    <a href="#" class="flex items-center px-6 py-2 hover:bg-primary-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Patients
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('doctor.schedules.index') }}" class="flex items-center px-6 py-2 hover:bg-primary-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Weekly Schedule
                    </a>
                </li>
                <li class="py-2">
                    <a href="#" class="flex items-center px-6 py-2 hover:bg-primary-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Medical Records
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('profile') }}" class="flex items-center px-6 py-2 hover:bg-primary-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        My Profile
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Mobile Header with Menu Toggle -->
        <div class="md:hidden bg-primary-700 text-white p-4 flex items-center justify-between">
            <h1 class="text-xl font-semibold">Doctor Portal</h1>
            <button id="mobile-menu-toggle" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="md:hidden hidden bg-primary-700 text-white">
            <nav class="px-4 py-2">
                <ul>
                    <li class="py-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('doctor.appointments.index') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Appointments
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="#" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Patients
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('doctor.schedules.index') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Weekly Schedule
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="#" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Medical Records
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('profile') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            <div class="mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Appointment Details</h1>
                        <div class="flex items-center mt-1 space-x-4">
                            <a href="{{ route('dashboard') }}" class="text-primary-600 hover:text-primary-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('doctor.appointments.index') }}" class="text-primary-600 hover:text-primary-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Back to appointments
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <!-- Appointment Information -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <h2 class="text-lg font-medium text-gray-800">Appointment Information</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Client</p>
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center mr-3">
                                                <img src="{{ $appointment->client->avatar_url }}" alt="{{ $appointment->client->full_name }}" class="h-10 w-10 rounded-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $appointment->client->full_name }}</p>
                                                <p class="text-sm text-gray-500">{{ $appointment->client->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Date & Time</p>
                                        <p class="font-medium text-gray-800">
                                            {{ $appointment->appointment_date->format('l, F j, Y') }} at {{ $appointment->appointment_date->format('h:i A') }}
                                        </p>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Status</p>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                     bg-{{ $appointment->status->color() }}-100 text-{{ $appointment->status->color() }}-800">
                                            {{ $appointment->status->label() }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 mb-1">Reason for Visit</p>
                                        <p class="text-gray-800">{{ $appointment->reason }}</p>
                                    </div>
                                    <div class="mb-4">
                                        <form action="{{ route('doctor.appointments.update-status', $appointment->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-1">
                                                <label for="status" class="text-sm text-gray-500">Update Status</label>
                                            </div>
                                            <div class="flex">
                                                <select name="status" id="status" class="rounded-md shadow-sm border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 w-full max-w-xs">
                                                    @foreach(App\Enums\AppointmentStatus::cases() as $status)
                                                        <option value="{{ $status->value }}" {{ $appointment->status === $status ? 'selected' : '' }}>
                                                            {{ $status->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="ml-3 px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Client Details -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6">
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <h2 class="text-lg font-medium text-gray-800">Client Details</h2>
                        </div>
                        <div class="p-6">
                            @if($client && $client->profile)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Gender</p>
                                            <p class="font-medium text-gray-800">{{ ucfirst($client->profile->gender->value) }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Age</p>
                                            <p class="font-medium text-gray-800">
                                                @if($client->profile->date_of_birth)
                                                    {{ $client->profile->date_of_birth->age }} years
                                                @else
                                                    N/A
                                                @endif
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Phone</p>
                                            <p class="font-medium text-gray-800">{{ $client->profile->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">City</p>
                                            <p class="font-medium text-gray-800">{{ $client->profile->city ?? 'N/A' }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Blood Type</p>
                                            <p class="font-medium text-gray-800">{{ $client->profile->blood_type ?? 'N/A' }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Height / Weight</p>
                                            <p class="font-medium text-gray-800">
                                                {{ $client->profile->height ? $client->profile->height . ' cm' : 'N/A' }} / 
                                                {{ $client->profile->weight ? $client->profile->weight . ' kg' : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if($client->profile->allergies || $client->profile->chronic_conditions)
                                    <div class="mt-2">
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Allergies</p>
                                            <p class="text-gray-800">{{ $client->profile->allergies ?? 'None reported' }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Chronic Conditions</p>
                                            <p class="text-gray-800">{{ $client->profile->chronic_conditions ?? 'None reported' }}</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700">
                                                This client has not completed their profile information.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Latest Health Record -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6">
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <h2 class="text-lg font-medium text-gray-800">Latest Health Record</h2>
                        </div>
                        <div class="p-6">
                            @if(isset($latestHealthRecord))
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Record Title</p>
                                            <p class="font-medium text-gray-800">{{ $latestHealthRecord->title }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Record Date</p>
                                            <p class="font-medium text-gray-800">{{ $latestHealthRecord->record_date->format('F j, Y') }}</p>
                                        </div>
                                        @if($latestHealthRecord->blood_pressure_systolic && $latestHealthRecord->blood_pressure_diastolic)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Blood Pressure</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->blood_pressure_systolic }}/{{ $latestHealthRecord->blood_pressure_diastolic }} mmHg</p>
                                            </div>
                                        @endif
                                        @if($latestHealthRecord->pulse_rate)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Pulse Rate</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->pulse_rate }} bpm</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        @if($latestHealthRecord->temperature)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Temperature</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->temperature }} °C</p>
                                            </div>
                                        @endif
                                        @if($latestHealthRecord->blood_sugar)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Blood Sugar</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->blood_sugar }} mg/dL</p>
                                            </div>
                                        @endif
                                        @if($latestHealthRecord->oxygen_saturation)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Oxygen Saturation</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->oxygen_saturation }}%</p>
                                            </div>
                                        @endif
                                        @if($latestHealthRecord->respiration_rate)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500 mb-1">Respiration Rate</p>
                                                <p class="font-medium text-gray-800">{{ $latestHealthRecord->respiration_rate }} breaths/min</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($latestHealthRecord->description)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500 mb-1">Description</p>
                                        <p class="text-gray-800">{{ $latestHealthRecord->description }}</p>
                                    </div>
                                @endif
                                @if($latestHealthRecord->files && $latestHealthRecord->files->count() > 0)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500 mb-2">Attached Files</p>
                                        <ul class="list-disc pl-5 text-gray-800">
                                            @foreach($latestHealthRecord->files as $file)
                                                <li>
                                                    <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="text-primary-600 hover:text-primary-800">
                                                        {{ $file->original_filename }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @else
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                No health records found for this client.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush
@endsection 