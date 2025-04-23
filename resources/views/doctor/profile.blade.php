@extends('layouts.app')

@section('title', 'HealthSync - Doctor Profile')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Profile Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Doctor Profile</h1>
                <p class="text-gray-600">Manage your professional and contact information</p>
            </div>
            <p class="text-sm text-gray-500 mt-2" id="last-updated">Last updated: {{ $profileData['created_at']->format('Y-m-d H:i:s') }}</p>
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
                                alt="Dr. {{ $profileData['first_name'] }} {{ $profileData['last_name'] }}" 
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
                        <h2 class="text-xl font-bold text-white" id="profile-name">Dr. {{ $profileData['first_name'] }} {{ $profileData['last_name'] }}</h2>
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
                            <h3 class="text-lg font-semibold text-gray-800">Office Details</h3>
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
                                    <p class="text-sm text-gray-500">Office Phone</p>
                                    <p class="font-medium" id="office-phone">{{ isset($profileData['profile']['office_phone']) ? $profileData['profile']['office_phone'] : 'Not provided' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Office Address</p>
                                    <p class="font-medium" id="office-address">{{ isset($profileData['profile']['office_address']) ? $profileData['profile']['office_address'] : 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Professional Information -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    <div class="bg-indigo-600 p-6 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-indigo-600 mb-4 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Professional Information</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Specialization & Details</h3>
                            <button class="text-primary-600 hover:text-primary-800 transition" id="edit-professional-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-3 mb-6" id="professional-details">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Specialization</p>
                                <p class="text-gray-800 font-medium" id="specialization">
                                    {{ isset($profileData['profile']['specialization']) ? $profileData['profile']['specialization'] : 'Not provided' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Consultation Fee</p>
                                <p class="text-gray-800 font-medium" id="consultation-fee">
                                    {{ isset($profileData['profile']['consultation_fee']) ? '$' . number_format($profileData['profile']['consultation_fee'], 2) : 'Not provided' }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <h4 class="font-medium text-gray-700 mb-2">About Me</h4>
                            
                            <div id="bio-container">
                                <p class="text-gray-800" id="bio">
                                    {{ isset($profileData['profile']['bio']) && !empty($profileData['profile']['bio']) ? $profileData['profile']['bio'] : 'No bio provided yet.' }}
                                </p>
                            </div>
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
            <h3 class="text-lg font-semibold text-white">Edit Office Information</h3>
        </div>
        <form id="contact-form" action="{{ route('profile.update.contact') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="edit-office-phone" class="block text-sm font-medium text-gray-700 mb-1">Office Phone</label>
                    <input type="tel" id="edit-office-phone" name="office_phone" value="{{ isset($profileData['profile']['office_phone']) ? $profileData['profile']['office_phone'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary-500">
                </div>
                
                <div>
                    <label for="edit-office-address" class="block text-sm font-medium text-gray-700 mb-1">Office Address</label>
                    <input type="text" id="edit-office-address" name="office_address" value="{{ isset($profileData['profile']['office_address']) ? $profileData['profile']['office_address'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary-500">
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-secondary-500 text-white rounded-md hover:bg-secondary-600 transition">Save Changes</button>
            </div>
        </form>
    </div>
    
    <!-- Professional Information Edit Form -->
    <div id="professional-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
        <div class="bg-indigo-600 px-6 py-4 rounded-t-xl">
            <h3 class="text-lg font-semibold text-white">Edit Professional Information</h3>
        </div>
        <form id="professional-form" action="{{ route('doctor.profile.update.professional') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="edit-specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                    <input type="text" id="edit-specialization" name="specialization" value="{{ isset($profileData['profile']['specialization']) ? $profileData['profile']['specialization'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label for="edit-consultation-fee" class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee ($)</label>
                    <input type="number" step="0.01" min="0" id="edit-consultation-fee" name="consultation_fee" value="{{ isset($profileData['profile']['consultation_fee']) ? $profileData['profile']['consultation_fee'] : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label for="edit-bio" class="block text-sm font-medium text-gray-700 mb-1">Professional Bio</label>
                    <textarea id="edit-bio" name="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ isset($profileData['profile']['bio']) ? $profileData['profile']['bio'] : '' }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Tell patients about your background, experience, and approach to care</p>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Save Changes</button>
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
    @vite(['resources/js/doctorProfile.js'])
@endpush