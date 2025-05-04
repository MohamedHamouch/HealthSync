@extends('layouts.app')

@section('title', 'HealthSync - Your Profile')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Profile Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start">
            <div>
                <div class="flex items-center mb-1">
                    <a href="{{ route('dashboard') }}" class="mr-2 text-primary-600 hover:text-primary-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                <h1 class="text-3xl font-bold text-gray-800">Your Profile</h1>
                </div>
                <p class="text-gray-600">Manage your personal and health information</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-4">
                <a href="{{ route('health-records.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Health Records
                </a>
                <p class="text-sm text-gray-500 self-center" id="last-updated">Last updated: {{ $profileData['created_at']->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8" id="profile-container">
            <!-- Left Column - Basic Profile -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    <!-- Profile Picture and Name -->
                    <div class="bg-primary-600 p-6 text-center">
                        <div class="relative w-32 h-32 mx-auto mb-4">
                            <img 
                                src="{{ $profileData['avatar'] ? asset('storage/' . $profileData['avatar']) : asset('images/defaults/avatar.png') }}" 
                                alt="{{ $profileData['first_name'] }} {{ $profileData['last_name'] }}" 
                                class="w-full h-full object-cover rounded-full border-4 border-white shadow-md"
                                id="profile-image"
                            >
                            <div class="absolute bottom-0 right-0">
                                <button class="bg-white p-1.5 rounded-full shadow-lg text-gray-600 hover:text-primary-600 transition" id="change-photo-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-white" id="profile-name">{{ $profileData['first_name'] }} {{ $profileData['last_name'] }}</h2>
                        <p class="text-primary-100" id="profile-role">{{ ucfirst($profileData['role']) }}</p>
                    </div>
                    
                    <!-- Basic Profile Information -->
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Basic Profile</h3>
                            <button class="text-primary-600 hover:text-primary-800 transition" id="edit-basic-profile-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-3" id="basic-profile-details">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">First Name</p>
                                <p class="text-gray-800 font-medium" id="first-name">{{ $profileData['first_name'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Last Name</p>
                                <p class="text-gray-800 font-medium" id="last-name">{{ $profileData['last_name'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Email</p>
                                <p class="text-gray-800 font-medium" id="email">{{ $profileData['email'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Username</p>
                                <p class="text-gray-800 font-medium" id="username">{{ $profileData['username'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Middle Column - Contact Information -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    <div class="bg-secondary-500 p-6 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-secondary-500 mb-4 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Contact Information</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Contact Details</h3>
                            <button class="text-primary-600 hover:text-primary-800 transition" id="edit-contact-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-4" id="contact-details">
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium" id="contact-email">{{ $profileData['email'] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium" id="phone">{{ isset($profileData['profile']['phone']) ? $profileData['profile']['phone'] : 'Not provided' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">City</p>
                                    <p class="font-medium" id="city">{{ isset($profileData['profile']['city']) ? $profileData['profile']['city'] : 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Health Information -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    <div class="bg-green-600 p-6 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-green-600 mb-4 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Health Information</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Health Details</h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('health-records.index') }}" class="text-green-600 hover:text-green-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                                <button class="text-primary-600 hover:text-primary-800 transition" id="edit-health-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6" id="health-details">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Date of Birth</p>
                                <p class="text-gray-800 font-medium" id="dob">
                                    {{ isset($profileData['profile']['date_of_birth']) ? \Carbon\Carbon::parse($profileData['profile']['date_of_birth'])->format('F d, Y') : 'Not provided' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Gender</p>
                                <p class="text-gray-800 font-medium" id="gender">
                                    {{ isset($profileData['profile']['gender']) ? ucfirst($profileData['profile']['gender']->value) : 'Not provided' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Blood Type</p>
                                <p class="text-gray-800 font-medium" id="blood-type">
                                    {{ isset($profileData['profile']['blood_type']) ? $profileData['profile']['blood_type'] : 'Not provided' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Height</p>
                                <p class="text-gray-800 font-medium" id="height">
                                    {{ isset($profileData['profile']['height']) ? $profileData['profile']['height'] . ' cm' : 'Not provided' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Weight</p>
                                <p class="text-gray-800 font-medium" id="weight">
                                    {{ isset($profileData['profile']['weight']) ? $profileData['profile']['weight'] . ' kg' : 'Not provided' }}
                                </p>
                            </div>
                            
                            @if(isset($profileData['profile']['height']) && isset($profileData['profile']['weight']) && $profileData['profile']['height'] > 0)
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">BMI</p>
                                    @php
                                        $height = $profileData['profile']['height'] / 100; // Convert cm to meters
                                        $weight = $profileData['profile']['weight'];
                                        $bmi = $weight / ($height * $height);
                                        
                                        $bmiCategory = '';
                                        if ($bmi < 18.5) {
                                            $bmiCategory = 'Underweight';
                                        } elseif ($bmi < 25) {
                                            $bmiCategory = 'Normal';
                                        } elseif ($bmi < 30) {
                                            $bmiCategory = 'Overweight';
                                        } else {
                                            $bmiCategory = 'Obese';
                                        }
                                    @endphp
                                    <p class="text-gray-800 font-medium" id="bmi">{{ number_format($bmi, 1) }} ({{ $bmiCategory }})</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <h4 class="font-medium text-gray-700 mb-2">Medical Conditions</h4>
                            
                            <div class="space-y-3" id="medical-conditions">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Allergies</p>
                                    <p class="text-gray-800" id="allergies">
                                        {{ isset($profileData['profile']['allergies']) && !empty($profileData['profile']['allergies']) ? $profileData['profile']['allergies'] : 'None reported' }}
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Chronic Conditions</p>
                                    <p class="text-gray-800" id="chronic-conditions">
                                        {{ isset($profileData['profile']['chronic_conditions']) && !empty($profileData['profile']['chronic_conditions']) ? $profileData['profile']['chronic_conditions'] : 'None reported' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Health Records</p>
                            <a href="{{ route('health-records.index') }}" class="inline-flex items-center mt-2 text-sm font-medium text-green-600 hover:text-green-800">
                                <span>Manage your health records</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8" id="file-upload-container" style="display: none;">
            <input type="file" id="profile-image-upload" accept="image/*" class="hidden">
        </div>
    </div>
</div>

<!-- Modal Backdrop -->
<div id="modal-backdrop" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <!-- Basic Profile Edit Form -->
    <div id="basic-profile-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
        <div class="bg-primary-600 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-white">Edit Basic Profile</h3>
        </div>
        <form id="basic-profile-form" action="{{ route('profile.update.basic') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="edit-first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="edit-first-name" name="first_name" value="{{ $profileData['first_name'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                
                <div>
                    <label for="edit-last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="edit-last-name" name="last_name" value="{{ $profileData['last_name'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                
                <div>
                    <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="edit-email" name="email" value="{{ $profileData['email'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                
                <div>
                    <label for="edit-username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="edit-username" name="username" value="{{ $profileData['username'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
    
    <!-- Contact Information Edit Form -->
    <div id="contact-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
        <div class="bg-secondary-500 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-white">Edit Contact Information</h3>
        </div>
        <form id="contact-form" action="{{ route('profile.update.contact') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="edit-phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="edit-phone" name="phone" value="{{ isset($profileData['profile']['phone']) ? $profileData['profile']['phone'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary-500">
                </div>
                
                <div>
                    <label for="edit-city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" id="edit-city" name="city" value="{{ isset($profileData['profile']['city']) ? $profileData['profile']['city'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary-500">
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-secondary-500 text-white rounded-md hover:bg-secondary-600 transition">Save Changes</button>
            </div>
        </form>
    </div>
    
    <!-- Health Information Edit Form -->
    <div id="health-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
        <div class="bg-green-600 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-white">Edit Health Information</h3>
        </div>
        <form id="health-form" action="{{ route('profile.update.health') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <!-- Grid layout for first row (Date of Birth & Gender) -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="edit-dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" id="edit-dob" name="date_of_birth" value="{{ isset($profileData['profile']['date_of_birth']) ? $profileData['profile']['date_of_birth'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    
                    <div>
                        <label for="edit-gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select id="edit-gender" name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Select Gender</option>
                            <option value="male" {{ isset($profileData['profile']['gender']) && $profileData['profile']['gender']->value == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ isset($profileData['profile']['gender']) && $profileData['profile']['gender']->value == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ isset($profileData['profile']['gender']) && $profileData['profile']['gender']->value == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                
                <!-- Grid layout for second row (Blood Type, Height, Weight) -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label for="edit-blood-type" class="block text-sm font-medium text-gray-700 mb-1">Blood Type</label>
                        <select id="edit-blood-type" name="blood_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Select</option>
                            <option value="A+" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ isset($profileData['profile']['blood_type']) && $profileData['profile']['blood_type'] == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="edit-height" class="block text-sm font-medium text-gray-700 mb-1">Height (cm)</label>
                        <input type="number" step="0.1" id="edit-height" name="height" value="{{ isset($profileData['profile']['height']) ? $profileData['profile']['height'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    
                    <div>
                        <label for="edit-weight" class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                        <input type="number" step="0.1" id="edit-weight" name="weight" value="{{ isset($profileData['profile']['weight']) ? $profileData['profile']['weight'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
                
                <!-- Medical conditions section -->
                <div>
                    <label for="edit-allergies" class="block text-sm font-medium text-gray-700 mb-1">Allergies</label>
                    <textarea id="edit-allergies" name="allergies" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ isset($profileData['profile']['allergies']) ? $profileData['profile']['allergies'] : '' }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Separate multiple allergies with commas</p>
                </div>
                
                <div>
                    <label for="edit-chronic-conditions" class="block text-sm font-medium text-gray-700 mb-1">Chronic Conditions</label>
                    <textarea id="edit-chronic-conditions" name="chronic_conditions" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ isset($profileData['profile']['chronic_conditions']) ? $profileData['profile']['chronic_conditions'] : '' }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Separate multiple conditions with commas</p>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
    
    <!-- Photo Upload Modal -->
    <div id="photo-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
        <div class="bg-primary-600 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-white">Change Profile Photo</h3>
        </div>  
        <form id="photo-form" action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <div class="w-32 h-32 mx-auto border-2 border-dashed border-gray-300 rounded-full flex items-center justify-center relative overflow-hidden">
                    <img id="photo-preview" src="{{ $profileData['avatar'] ? asset('storage/' . $profileData['avatar']) : asset('images/defaults/avatar.png') }}" alt="Profile Photo Preview" class="w-full h-full object-cover hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="photo-placeholder">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="photo-upload" class="block text-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition cursor-pointer">
                    Select Photo
                </label>
                <input type="file" id="photo-upload" name="avatar" class="hidden" accept="image/*">
                <p class="text-center text-sm text-gray-500 mt-2">Maximum file size: 5MB. Supported formats: JPG, PNG</p>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">Upload Photo</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
    @vite(['resources/js/clientProfile.js'])
@endpush


