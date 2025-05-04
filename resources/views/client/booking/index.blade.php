@extends('layouts.app')

@section('title', 'Book Appointment - HealthSync')

@section('content')
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-primary-600 hover:text-primary-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="mb-6">
                    <div class="flex items-center mb-2">
                        <a href="{{ route('dashboard') }}" class="mr-2 text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <h3 class="text-lg font-medium text-gray-900">Book a New Appointment</h3>
                    </div>
                    <p class="text-gray-600">Select a doctor and date to see available appointment times.</p>
                </div>
                
                <form action="{{ route('client.booking.check-availability') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Select Doctor</label>
                        <select id="doctor_id" name="doctor_id" required 
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                            <option value="">-- Select a doctor --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor['id'] }}">
                                    Dr. {{ $doctor['name'] }} - {{ $doctor['specialization'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input type="date" id="date" name="date" required min="{{ date('Y-m-d') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Check Availability
                        </button>
                    </div>
                </form>
                
                <div class="bg-gray-50 p-4 rounded mt-8">
                    <h4 class="font-medium text-gray-900 mb-2">About Appointments</h4>
                    <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                        <li>Choose from our network of qualified healthcare professionals</li>
                        <li>Select a date that works for your schedule</li>
                        <li>View available time slots based on doctor's working hours</li>
                        <li>Provide a reason for your visit to help the doctor prepare</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection 